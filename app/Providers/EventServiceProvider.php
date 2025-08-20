<?php

namespace App\Providers;

use App\Listeners\FlushPageCacheListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Event::listen(
            Registered::class,
        );

        Event::listen('eloquent.updated: *', FlushPageCacheListener::class);
        Event::listen('eloquent.created: *', FlushPageCacheListener::class);
        Event::listen('eloquent.deleted: *', FlushPageCacheListener::class);
    }
}
