<?php

namespace Support\Traits\Models;

use App\Observers\ModelCacheObserver;

trait Cacheable
{
    protected static function bootCacheable()
    {
        static::observe(ModelCacheObserver::class);
    }

    public static function getCacheKeys(): array
    {
        return [];
    }

    public static function getCacheTag(): string
    {
        return str(static::class)->slug('_')->value();
    }
}
