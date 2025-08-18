<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function () {
                //
            });
    }
}
