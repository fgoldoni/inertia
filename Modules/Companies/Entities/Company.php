<?php
namespace Modules\Companies\Entities;

use App\Traits\BelongsToUser;
use App\Traits\UsedByTeams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\CompanyFactory;
use Modules\Jobs\Entities\Job;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use HasFactory, HasSlug, BelongsToUser, SoftDeletes, UsedByTeams;
    use LogsActivity;

    protected $guarded = [];

    protected $casts = [
        'online' => 'boolean',
    ];

    protected static function newFactory(): CompanyFactory
    {
        return CompanyFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "Company has been {$eventName}")
            ->useLogName('Company')
            ->logOnly(['name', 'content', 'phone'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
