<?php
namespace Modules\Attachments\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Attachments\Http\Requests\ApiStoreAttachmentRequest;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Attachments\Transformers\ApiAttachmentsResource;
use Modules\Users\Repositories\Contracts\UsersRepository;

class AttachmentsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly AttachmentsRepository $attachmentsRepository,
        private readonly UsersRepository $usersRepository,
    ) {
    }

    public function index()
    {
        return view('attachments::index');
    }

    public function store(ApiStoreAttachmentRequest $request)
    {
        $fileName = Storage::disk(config('app.system.disks.uploads'))
            ->put(
                now()->format('Y') . '/' . now()->format('m'),
                $request->file('attachment'),
                'public'
            );

        $attachment = $this->attachmentsRepository->create([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'disk' => $request->get('disk', config('app.system.disks.uploads')),
            'filename' => $fileName,
            'mime_type' => $request->get('mime_type'),
            'user_id' => $request->get('user_id', null),
            'size' => $request->get('size'),
        ]);

        if ($request->user_id) {
            $this->usersRepository->find($request->user_id)->attachments()->save($attachment);
        }

        return $this->response->json(
            ['data' => new ApiAttachmentsResource($attachment)],
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
