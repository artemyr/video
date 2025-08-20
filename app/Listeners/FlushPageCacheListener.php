<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class FlushPageCacheListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($eventCode, $model): void
    {
        $routes = config('cache.cached_routes');
        foreach ($routes as $route) {
            Cache::forget('page_cache_' . $route);
        }
    }
}
