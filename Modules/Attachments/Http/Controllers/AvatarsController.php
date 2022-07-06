<?php

namespace Modules\Attachments\Http\Controllers;

use App\Models\Team;
use App\Repositories\Criteria\Where;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Attachments\Http\Requests\StoreAvatarRequest;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Teams\Repositories\Contracts\TeamsRepository;

class AvatarsController extends Controller
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

    public function store(StoreAvatarRequest $request)
    {
        $attachment = [];

        $file = $request->file('file');

        $request->file('file')
            ->store(
                now()->format('Y') . '/' . now()->format('m'),
                config('app.system.disks.avatars')
            );

        $attachment['filename'] = now()->format('Y') . '/' . now()->format('m') . '/' . $file->hashName();

        return $this->response->json(['data' => $attachment], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }


    public function show($id)
    {
        return view('attachments::show');
    }


    public function edit($id)
    {
        return view('attachments::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $filename, string $model)
    {
        $model = app()->make($model);

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        if ($model->where('avatar_path', urldecode($filename))->exists()) {
            Storage::disk(config('app.system.disks.avatars'))->delete(urldecode($filename));

            $model->where('avatar_path', urldecode($filename))->get()
                ->each(function ($job) {
                    $job?->forceFill([
                        'avatar_path' => null,
                    ])->save();
                });
        }

        return $this->response->json([], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
