<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasThumbnail;

class Portfolio extends Model
{
    use  HasThumbnail;

    protected $guarded = ['created_at'];

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

    public function video(): ?string
    {
        if (empty($this->video)) {
            return null;
        }

        return asset('storage/video/' . $this->video);
    }

    public function scopeSorted(Builder $query)
    {
        $query->orderBy('sort')
            ->orderBy('id', 'desc');
    }
}
