<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Support\Traits\Models\Cacheable;
use Support\Traits\Models\HasThumbnail;

class Review extends Model
{
    use HasThumbnail;
    use Cacheable;

    protected $guarded = ['created_at'];

    protected function thumbnailDir(): string
    {
        return 'reviews';
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
        static::updating(function (Review $item) {
            if ($item->isDirty('image')) {
                $oldFile = $item->getOriginal('image');

                if ($oldFile && Storage::disk('images')->exists($oldFile)) {
                    Storage::disk('images')->delete($oldFile);
                }
            }
        });

        static::deleting(function (Review $item) {
            if ($item->image && Storage::disk('images')->exists($item->image)) {
                Storage::disk('images')->delete($item->image);
            }
        });
    }
}
