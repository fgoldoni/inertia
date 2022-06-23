<?php
namespace Modules\Attachments\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $appends = ['url'];

    public function attachable(): MorphTo
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function getUrlAttribute(): string
    {
        return $this->filename
            ? Storage::disk($this->uploadDisk())->url($this->filename)
            : $this->defaultAvatarUrl();
    }

    public function size(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value/1000,
        );
    }

    /**
     * Get the default upload photo URL if no upload photo has been uploaded.
     */
    protected function defaultAvatarUrl(): string
    {
        return 'https://ui-uploads.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that upload photos should be stored on.
     */
    protected function uploadDisk(): string
    {
        return config('app.system.disks.uploads');
    }

    public static function boot()
    {
        parent::boot();

        self::deleted(function ($attachment) {
            $attachment->deleteFile();
        });
    }

    public function deleteFile()
    {
        Storage::disk($this->disk)->delete($this->filename);
    }
}
