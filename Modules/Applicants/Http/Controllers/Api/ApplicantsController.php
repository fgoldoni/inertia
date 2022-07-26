<?php
namespace Modules\Applicants\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereIn;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WherePublished;
use App\Repositories\Criteria\WhereUser;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Applicants\Entities\Applicant;
use Modules\Applicants\Http\Requests\ApiStoreApplicantStatusRequest;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Transformers\Api\ApplicantsResource;
use Modules\Applicants\Transformers\CandidateResource;
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
                new OrderBy('applicants.id', 'desc'),
                new EagerLoad([
                    'attachments' => fn ($query) => $query->where('attachments.type', 'resumes'),
                    'candidate:id,name,email',
                    'job' => function (BelongsTo $query) {
                        $query->with(['city', 'country']);
                    },
                ]),
                new WhereHas('job', function (Builder $query) {
                    $query->with(['company.categories', 'city']);
                }),
                new WhereHas('candidate', function (Builder $query) {
                    $query->where('users.id', auth()->user()->id);
                })
            ])->all()
        );

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
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

        $attachments = $this->attachmentsRepository->withCriteria([
            new Where('type', 'resumes'),
            new WhereIn('attachments.id', $request->resumes),
        ])->get();

        $attachments->each(function ($attachment) use ($applicant, $user) {
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
        });



        return $this->response->json(
            [
                'message' => __('The (:item) has been successfully created', ['item' => 'applicant']),
                'applicant' => new ApplicantsResource(
                    $applicant->fresh()->load(['job.company', 'candidate', 'attachments'])
                )
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function show(Applicant $applicant)
    {
        $applicant = new ApplicantsResource($this->applicantsRepository->withCriteria([
            new EagerLoad([
                'attachments',
                'candidate:id,name,email',
                'job' => fn ($query) => $query->with('city'),
            ]),
            new WhereHas('job', function (Builder $query) {
                $query->where(
                    'jobs.team_id',
                    session(
                        config('app.system.sessions.keys.team'),
                        auth()->user()->currentTeam?->id
                    )
                )->with(['team', 'company.categories', 'categories', 'tags:id,name']);
            }),
        ])->find($applicant->id));


        return $this->response->json(['data' => $applicant], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

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
