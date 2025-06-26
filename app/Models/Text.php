<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\Cacheable;

class Text extends Model
{
    use Cacheable;

    protected $guarded = ['created_at'];

    public function scopeSorted(Builder $query)
    {
        $query->orderBy('sort')
            ->orderBy('id', 'desc');
    }

    protected function getCacheKeys(): array
    {
        return ['text_home_page', 'text_bottom_on_prices_page'];
    }
}
