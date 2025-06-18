<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\Cacheable;

class Price extends Model
{
    use Cacheable;

    protected $guarded = ['created_at'];

    public function scopeSorted(Builder $query)
    {
        $query->orderBy('sort')
            ->orderBy('id', 'desc');
    }

    public function scopeFiltered(Builder $query)
    {
        $query->where('active', true);
    }

    protected function getCacheKeys(): array
    {
        return [
            'price_on_price_page',
            'text_bottom_on_prices_page'
        ];
    }
}
