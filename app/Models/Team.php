<?php

namespace App\Models;

use App\Traits\Categorizable;
use App\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use Modules\Attachments\Traits\AttachableTrait;
use Modules\Teams\Enums\ColorType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends JetstreamTeam
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use HasAvatar;
    use AttachableTrait;
    use Categorizable;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
        'color' => ColorType::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'subdomain',
        'display_name',
        'personal_team',
        'avatar_path',
        'color',
        'user_id',
    ];

    protected $appends = [
        'avatar_url',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "Team has been {$eventName}")
            ->useLogName('Team')
            ->logOnly(['name', 'display_name', 'subdomain'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get all of the team's users including its owner.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allUsers()
    {
        return $this->users->isNotEmpty() ? $this->users->merge([$this->owner]) : collect([$this->owner])->filter();
    }
}
