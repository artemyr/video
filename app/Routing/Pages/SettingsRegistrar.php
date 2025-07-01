<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class SettingsRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function () {

                Route::controller(SettingsController::class)
                    ->group(function () {
                        Route::get('/admin/settings/create', 'pageCreate')
                            ->name('admin.settings.create.page');

                        Route::post('/admin/settings/add', 'create')
                            ->name('admin.settings.create');

                        Route::post('/admin/settings/{item}/update', 'update')
                            ->name('admin.settings.update');

                        Route::get('/admin/settings/{item}/detail', 'detail')
                            ->name('admin.settings.detail');

                        Route::delete('/admin/settings/{item}/destroy', 'destroy')
                            ->name('admin.settings.destroy');

                        Route::get('/admin/settings/index', 'index')
                            ->name('admin.settings.index');
                    });
            });
    }
}
