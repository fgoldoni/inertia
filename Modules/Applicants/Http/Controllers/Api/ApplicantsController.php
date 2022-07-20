<?php
namespace Modules\Applicants\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Transformers\Api\ApplicantsResource;

class ApplicantsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly ApplicantsRepository $applicantsRepository,
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

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
     * @param Request $request
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
}
