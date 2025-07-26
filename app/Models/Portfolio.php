<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Support\Casts\SizeCast;
use Support\Traits\Models\Cacheable;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasVideoGallery;

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
}
