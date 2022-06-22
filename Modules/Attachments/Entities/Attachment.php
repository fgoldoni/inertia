<?php
namespace Modules\Attachments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $appends = ['url'];

    public function attachable(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function getUrlAttribute()
    {
        return $this->filename
            ? Storage::disk($this->avatarDisk())->url($this->filename)
            : $this->defaultAvatarUrl();
    }
    /**
     * Get the default avatar photo URL if no avatar photo has been uploaded.
     */
    protected function defaultAvatarUrl(): string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->filename) . '&color=7F9CF5&background=EBF4FF';
    }
    /**
     * Get the disk that avatar photos should be stored on.
     */
    protected function avatarDisk(): string
    {
        return 'upload';
    }


}
