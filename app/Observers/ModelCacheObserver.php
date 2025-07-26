<?php

namespace App\Observers;

use App\Events\ModelCreatedEvent;
use App\Events\ModelDeletedEvent;
use App\Events\ModelUpdatedEvent;
use Illuminate\Database\Eloquent\Model;

class ModelCacheObserver
{
    public function created(Model $model): void
    {
        event(new ModelCreatedEvent($model));
    }

    public function updated(Model $model): void
    {
        event(new ModelUpdatedEvent($model));

    }

    public function deleted(Model $model): void
    {
        event(new ModelDeletedEvent($model));
    }
}
