<?php

namespace Modules\Comments\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereHas;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Transformers\Api\ApplicantsResource;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Http\Requests\ApiViewCommentRequest;
use Modules\Comments\Repositories\Contracts\CommentsRepository;
use Modules\Comments\Transformers\ApiCommentsResource;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class CommentsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly CommentsRepository $commentsRepository,
    ) {
    }

    public function index(ApiViewCommentRequest $request)
    {
        $this->authorize('viewAny', Comment::class);

        $comments = Comment::transform(
            $this->commentsRepository->withCriteria([
                new EagerLoad(['user:id,name,email,profile_photo_path']),
                new OrderBy('comments.id', 'asc'),
                new Where('comments.commentable_type', $request->model),
                new Where('comments.commentable_id', $request->modelId),
            ])->all([
                'id',
                'content',
                'commentable_type',
                'commentable_id',
                'reply',
                'user_id',
                'created_at',
            ])
        );

        return $this->response->json(['data' => $comments], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('comments::create');
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
        return view('comments::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('comments::edit');
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
