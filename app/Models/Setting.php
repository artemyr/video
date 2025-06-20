<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Models\Cacheable;

class Setting extends Model
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
        return [
            'setting_home_page',
            'setting_phone',
            'setting_footer_text',
            'setting_tg',
            'setting_text_1_on_contact_page',
            'setting_logo_on_contact_page',
            'setting_favicon'
        ];
    }

    protected function clearCache(Model $item): void
    {
        foreach ($this->getCacheKeys() as $cacheKey) {
            Cache::forget($cacheKey);
        }

        if (
            str($item->code)->startsWith('title.')
        ) {
            Cache::forget('setting_title_' . str($item->code)->ltrim('title.'));
        }

        if (
            str($item->code)->startsWith('description.')
        ) {
            Cache::forget('setting_title_' . str($item->code)->ltrim('description.'));
        }
    }
}
