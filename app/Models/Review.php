<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Review extends Model
{
    use HasThumbnail;

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
}
