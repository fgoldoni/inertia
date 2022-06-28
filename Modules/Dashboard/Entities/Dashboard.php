<?php
namespace Modules\Dashboard\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\DashboardFactory::new();
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->as('layout')
            ->using(DashboardUser::class)
            ->withPivot('id', 'x', 'y', 'w', 'h', 'component')
            ->withTimestamps();
    }
}
