<?php
namespace Modules\Attachments\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attachments\Entities\Attachment;
use Modules\Attachments\Http\Requests\StoreAttachmentRequest;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class AttachmentsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly AttachmentsRepository $attachmentsRepository,
    ) {
    }
    public function index()
    {
        return view('attachments::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('attachments::create');
    }

    public function store(StoreAttachmentRequest $request)
    {
        $file = $request->file('file');

        $request->file('file')
            ->store(
                now()->format('Y') . '/' . now()->format('m'),
                $request->get('disk', config('app.system.disks.uploads'))
            );

        $attachment = $this->attachmentsRepository->create([
            'name' => $file->getClientOriginalName(),
            'disk' => $request->get('disk', config('app.system.disks.uploads')),
            'filename' => now()->format('Y') . '/' . now()->format('m') . '/' . $file->hashName(),
            'mime_type' => $file->getMimeType(),
            'user_id' => auth()->user()->id,
            'size' => $file->getSize(),
        ]);

        return $this->response->json(['data' => $attachment], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('attachments::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('attachments::edit');
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

    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return $this->response->json(['data' => $attachment], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
