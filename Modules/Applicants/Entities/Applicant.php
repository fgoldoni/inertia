<?php

namespace Modules\Applicants\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Applicants\Database\factories\ApplicantFactory;
use Modules\Applicants\Enums\Status;
use Modules\Attachments\Traits\AttachableTrait;
use Modules\Comments\Entities\Comment;
use Modules\Jobs\Entities\Job;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Applicant extends Pivot
{
    use LogsActivity;
    use AttachableTrait;
    use SoftDeletes;
    use HasFactory;

    protected $table = 'applicants';

    protected $guarded = [];

    protected $casts = [
        'status' => Status::class,
    ];

    public $incrementing = true;

    protected static function newFactory(): ApplicantFactory
    {
        return ApplicantFactory::new();
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault(['name' => ''])->withoutGlobalScopes();
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id')->withDefault(['name' => ''])->withoutGlobalScopes();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "Applicant has been {$eventName}")
            ->useLogName('applicant')
            ->logOnly(['user_id', 'job_id', 'phone', 'message', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
