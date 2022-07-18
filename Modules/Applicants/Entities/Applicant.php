<?php
namespace Modules\Applicants\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Jobs\Entities\Job;

class Applicant extends Pivot
{

    protected $table = 'applicants';

    protected $guarded = [];

    public $incrementing = true;

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault(['name' => '']);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id')->withDefault(['name' => '']);
    }
}
