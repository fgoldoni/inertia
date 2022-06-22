<?php

namespace Modules\Attachments\Http\Controllers\Api;

use App\Services\Flag\Src\Flag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Attachments\Entities\Attachment;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class AttachmentsController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly AttachmentsRepository $attachmentsRepository, private readonly RolesRepository $rolesRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
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


    public function store(Request $request)
    {
        $file = $request->file('file');

        $request->file('file')->store(now()->format('Y') . '/' . now()->format('m'), 'upload');

        $attachment = $this->attachmentsRepository->create([
            'filename' => now()->format('Y') . '/' . now()->format('m') .'/'. $file->hashName(),
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


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Attachment $attachment)
    {
        Storage::disk('upload')->delete( $attachment->filename);

        $attachment->delete();

        return $this->response->json(['data' => $attachment], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
