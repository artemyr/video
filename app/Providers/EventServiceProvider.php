<?php

namespace App\Providers;

use App\Events\ModelCreatedEvent;
use App\Events\ModelDeletedEvent;
use App\Events\ModelUpdatedEvent;
use App\Listeners\FlushModelCacheListener;
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

        Event::listen(ModelCreatedEvent::class, FlushModelCacheListener::class);
        Event::listen(ModelUpdatedEvent::class, FlushModelCacheListener::class);
        Event::listen(ModelDeletedEvent::class, FlushModelCacheListener::class);
    }
}
