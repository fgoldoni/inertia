<?php
namespace Modules\Applicants\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Applicants\Http\Requests\ApiStoreApplicantStatusRequest;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Transformers\Api\ApplicantsResource;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class ApplicantsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly ApplicantsRepository $applicantsRepository,
        private readonly UsersRepository $usersRepository,
        private readonly TeamsRepository $teamsRepository,
        private readonly AttachmentsRepository $attachmentsRepository,
    ) {
    }

    public function index()
    {
        $result = ApplicantsResource::collection(
            $this->applicantsRepository->withCriteria([
                new EagerLoad([
                    'attachments' => fn ($query) => $query->where('attachments.type', 'resumes'),
                    'candidate:id,name,email',
                    'job' => function (BelongsTo $query) {
                        $query->with(['city', 'country']);
                    },
                ]),
                new WhereHas('job', function (Builder $query) {
                    $query->where(
                        'jobs.team_id',
                        session(
                            config('app.system.sessions.keys.team'),
                            auth()->user()->currentTeam?->id
                        )
                    );
                }),
                new WhereHas('candidate', function (Builder $query) {
                    $query->where('users.id', auth()->user()->id);
                })
            ])->all()
        );

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('applicants::create');
    }

    public function store(ApiStoreApplicantStatusRequest $request)
    {
        $user = $this->userFromEmail($request->email);

        $applicant = $this->applicantsRepository->create(array_merge(
            $request->only(
                'user_id',
                'job_id',
                'phone',
                'status',
                'message',
            ),
            [
                'user_id' => $user->id
            ]
        ));

        $attachment = $this->attachmentsRepository->withCriteria([
            new Where('type', 'resumes'),
        ])->find($request->resume);

        if (!$attachment->attachable_type) {
            $applicant->attachments()->save($attachment);

            if (!$attachment->user_id) {
                $attachment->user_id = $user->id;
                $attachment->save();
            }
        } else {
            $newAttachment = $attachment->replicate();
            $applicant->attachments()->save($newAttachment);

            $newAttachment->created_at = now();
            $newAttachment->updated_at = now();
            $newAttachment->user_id = $user->id;
            $newAttachment->save();
        }

        return $this->response->json(
            [
                'message' => __('The (:item) has been successfully created', ['item' => 'applicant']),
                'applicant' => new ApplicantsResource($applicant->fresh()->load(['job', 'candidate', 'attachments']))
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('applicants::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('applicants::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $items = $this->applicantsRepository->withCriteria([
            new WhereKey($request->selected)
        ])->get();

        foreach ($items as $item) {
            $item->delete();
        }

        return $this->response->json(
            ['message' => __('The Applicant(s) has been successfully deleted')],
            Response::HTTP_NO_CONTENT,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    private function userFromEmail(string $email)
    {
        $team = $this->teamsRepository->find(session(config('app.system.sessions.keys.team')));

        if ($this->usersRepository->isExist($email)) {
            $user = $this->usersRepository->findWhereFirst('email', $email);
        } else {
            $user = $this->usersRepository->create(
                [
                    'email' => $email,
                    'name' => "{$team->display_name} User",
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(8)),
                ]
            );

            $user->syncRoles(config('app.system.users.roles.default'));
        }

        $this->teamsRepository->attachUser($team, $user);

        return $user;
    }
}
