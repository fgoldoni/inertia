<?php
namespace Modules\Teams\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Has;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Teams\Http\Requests\TeamRequest;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Transformers\TeamResource;

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
        $data = TeamResource::collection($this->teamsRepository->withCriteria([
            new EagerLoad(['owner:id,name,email,profile_photo_path', 'users']),
            new Has('users'),
            new WithTrashed(),
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
        $data = new TeamResource($this->teamsRepository->withCriteria([
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
