<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Support\Casts\SizeCast;
use Support\Helpers\VideoSizeHelper;
use Support\Traits\Models\Cacheable;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasVideoGallery;
use Support\ValueObjects\Size;

class Portfolio extends Model
{
    use HasThumbnail;
    use HasVideoGallery;
    use Cacheable;

    protected $guarded = ['created_at'];

    protected $casts = [
        'size' => SizeCast::class
    ];

    protected function thumbnailDir(): string
    {
        return 'portfolio';
    }

    protected function thumbnailColumn(): string
    {
        return 'image';
    }

    public function image(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return asset('storage/images/' . $this->image);
    }

    public function scopeSorted(Builder $query)
    {
        $query->orderBy('sort')
            ->orderBy('id', 'desc');
    }

    public function scopeFiltered(Builder $query)
    {
        $query->where('active', true);
    }

    protected static function booted()
    {
        static::creating(function (Portfolio $item) {
            if ($item->size->isEmpty()) {
                $storageVideos = Storage::disk('video');
                $videoPath = $storageVideos->path($item->video);
                $item->size = Size::make(VideoSizeHelper::analyze($videoPath));
            }
        });
        static::updating(function (Portfolio $item) {
            if ($item->size->isEmpty()) {
                $storageVideos = Storage::disk('video');
                $videoPath = $storageVideos->path($item->video);
                $item->size = Size::make(VideoSizeHelper::analyze($videoPath));
            }
            if ($item->isDirty('image')) {
                $oldFile = $item->getOriginal('image');

                if ($oldFile && Storage::disk('images')->exists($oldFile)) {
                    Storage::disk('images')->delete($oldFile);
                }
            }
            if ($item->isDirty('video')) {
                $oldFile = $item->getOriginal('video');

                if ($oldFile && Storage::disk('video')->exists($oldFile)) {
                    Storage::disk('video')->delete($oldFile);
                }
            }
        });

        static::deleting(function (Portfolio $item) {
            if ($item->image && Storage::disk('images')->exists($item->image)) {
                Storage::disk('images')->delete($item->image);
            }
            if ($item->video && Storage::disk('video')->exists($item->video)) {
                Storage::disk('video')->delete($item->video);
            }
        });
    }
}
