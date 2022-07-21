<?php
namespace Modules\Teams\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Where;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Teams\Http\Requests\TeamRequest;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Transformers\ApiTeamResource;

class TeamsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly TeamsRepository $teamsRepository,
        private readonly Request $request
    ) {
    }

    public function index()
    {
        $data = [];
        $data['team'] = ApiTeamResource::collection($this->teamsRepository->withCriteria([
            new EagerLoad([
                'attachments' => function ($query) {
                    $query->where('attachments.disk', config('app.system.disks.uploads'));
                }
            ]),
        ])->all());

        return $this->response->json(['data' => $data], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function create()
    {
        return view('teams::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TeamRequest $request, string $subdomain)
    {
        $data = new ApiTeamResource($this->teamsRepository->withCriteria([
            new EagerLoad([
                'attachments' => function ($query) {
                    $query->where('attachments.disk', config('app.system.disks.uploads'));
                }
            ]),
            new Where('subdomain', $subdomain)
        ])->first());

        return $this->response->json(['data' => $data], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function edit($id)
    {
        return view('teams::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
