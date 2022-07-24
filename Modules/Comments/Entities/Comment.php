<?php

namespace Modules\Comments\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Comments\Database\factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;
    public $guarded = [];

    protected static function newFactory(): CommentFactory
    {
        return CommentFactory::new();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function allFor($model, $modelId): array
    {
        $comments = [];
        $byId = [];
        $records = self::where([
            'commentable_type' => $model,
            'commentable_id' => $modelId
        ])->orderBy('id', 'asc')->get();

        $records->load('user');

        foreach ($records as $record) {
            if ($record->reply) {
                $byId[$record->reply]->attributes['replies'][] = $record;
            } else {
                $record->attributes['replies'] = [];
                $byId[$record->id] = $record;
                $comments[] = $record;
            }
        }
        return array_reverse($comments);
    }

    public static function isCommentable($model, $modelId): bool
    {
        if (class_exists($model) && method_exists($model, 'comments')) {
            return $model::where(['id' => $modelId])->exists();
        } else {
            return false;
        }
    }
}
