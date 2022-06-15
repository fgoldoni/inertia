<?php
namespace App\Models;

use Grosv\LaravelPasswordlessLogin\Traits\PasswordlessLogin;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\Users\Collections\UserCollection;
use Modules\Users\Entities\Session;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;
    use HasRoles;
    use PasswordlessLogin;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Define if user is an admin.
     */
    public function isAdministrator(): bool
    {
        return $this->hasRole(config('app.system.users.roles.administrator'));
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function lastLogin(): HasOne
    {
        return $this->hasOne(Session::class)->latestOfMany('last_activity')->withDefault();
    }

    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate');
    }

    public function canBeImpersonated(): bool
    {
        return !$this->isAdministrator();
    }

    public function newCollection(array $models = []): Collection
    {
        return new UserCollection($models);
    }
}
