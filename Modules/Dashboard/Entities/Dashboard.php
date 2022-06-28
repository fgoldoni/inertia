<?php
namespace Modules\Dashboard\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\DashboardFactory::new();
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
