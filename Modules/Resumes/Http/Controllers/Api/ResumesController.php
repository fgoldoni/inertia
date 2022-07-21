<?php

namespace Modules\Resumes\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Attachments\Transformers\ApiAttachmentsResource;
use Modules\Jobs\Services\Contracts\JobsServiceInterface;

class ResumesController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly AttachmentsRepository $attachmentsRepository,
    ) {
    }

    public function index()
    {
        $result = ApiAttachmentsResource::collection($this->attachmentsRepository->withCriteria([
            new Where('attachable_type', User::class),
            new Where('attachable_id', auth()->user()->id),
            new Where('type', 'resumes'),
        ])->all());

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('resumes::create');
    }

    /**
     * Store a newly created resource in storage.
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
        return view('resumes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('resumes::edit');
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
        $items = $this->attachmentsRepository->withCriteria([
            new WhereKey($request->selected)
        ])->get();

        foreach ($items as $item) {
            $item->delete();
        }

        return $this->response->json(
            ['message' => __('The Resume(s) has been successfully deleted')],
            Response::HTTP_NO_CONTENT,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
