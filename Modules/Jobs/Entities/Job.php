<?php
namespace Modules\Jobs\Entities;

use App\Models\User;
use App\Traits\BelongsToUser;
use App\Traits\Categorizable;
use App\Traits\HasAvatar;
use App\Traits\JobAttribute;
use App\Traits\UsedByTeams;
use App\Traits\WithinDays;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Applicants\Entities\Applicant;
use Modules\Attachments\Traits\AttachableTrait;
use Modules\Companies\Entities\Company;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Modules\Countries\Entities\Division;
use Modules\Jobs\Builders\JobBuilder;
use Modules\Jobs\Database\factories\JobFactory;
use Modules\Jobs\Enums\JobState;
use Modules\Jobs\Enums\SalaryType;
use Modules\Tags\Traits\TaggableTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Job extends Model
{
    use HasFactory;
    use HasSlug;
    use HasAvatar;
    use HasTranslations;
    use Categorizable;
    use BelongsToUser;
    use SoftDeletes;
    use WithinDays;
    use JobAttribute;
    use AttachableTrait;
    use LogsActivity;
    use UsedByTeams;
    use TaggableTrait;

    protected $guarded = [];

    public array $translatable = ['name'];

    protected $casts = [
        'state' => JobState::class,
        'salary_type' => SalaryType::class,
        'negotiable' => 'boolean',
        'live_at' => 'datetime',
        'closing_to' => 'date',
    ];

    protected $appends = [
        'avatar_url',
    ];

    protected static function newFactory(): JobFactory
    {
        return JobFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function toArray(): array
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withDefault();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->withDefault(['name' => '']);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class)->withDefault(['name' => '']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->withDefault(['name' => '']);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "Job has been {$eventName}")
            ->useLogName('job')
            ->logOnly(['name', 'content', 'salary_min', 'content', 'salary_max', 'seo_title', 'seo_description', 'company_id', 'closing_to', 'address'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    #[Pure]
    public function newEloquentBuilder($query): Builder
    {
        return new JobBuilder($query);
    }

    public function candidates(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'applicants', 'job_id', 'user_id')
            ->using(Applicant::class)
            ->as('candidates')
            ->withPivot('phone', 'message')
            ->withoutGlobalScopes()
            ->withTimestamps();
    }
}
