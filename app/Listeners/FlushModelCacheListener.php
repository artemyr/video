<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;

class FlushModelCacheListener
{
    public function handle(object $event): void
    {
        if (method_exists($event->model, 'getCacheKeys')) {
            foreach ($event->model::getCacheKeys() as $cacheKey) {
                Cache::forget($cacheKey);
            }
        }

        if (method_exists($event->model, 'getCacheTag')) {
            if (!empty($event->model::getCacheTag())) {
                Cache::tags($event->model::getCacheTag())->flush();
            }
        }
    }
}
