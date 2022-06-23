<?php

namespace Modules\Attachments\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereNot;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Attachments\Http\Requests\StoreAvatarRequest;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class AvatarsController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly AttachmentsRepository $attachmentsRepository, private readonly JobsRepository $jobsRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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


    public function store(StoreAvatarRequest $request)
    {
        $file = $request->file('file');

        $request->file('file')->store(now()->format('Y') . '/' . now()->format('m'),  config('app.system.disks.avatars'));

        $attachment['filename'] = now()->format('Y') . '/' . now()->format('m') . '/' . $file->hashName();

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
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($filename)
    {
        Storage::disk(config('app.system.disks.avatars'))->delete(urldecode($filename));

        $this->jobsRepository->withCriteria([
            new Where('avatar_path', urldecode($filename)),
        ])->get()->each(function ($job) {
            $job?->forceFill([
                'avatar_path' => null,
            ])->save();
        });

        return $this->response->json([], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
