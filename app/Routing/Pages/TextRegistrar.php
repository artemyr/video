<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\TextController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class TextRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::controller(TextController::class)
                    ->group(function () {
                        Route::get('/admin/text/create', 'pageCreate')
                            ->name('admin.text.create.page');

                        Route::post('/admin/text/add', 'create')
                            ->name('admin.text.create');

                        Route::post('/admin/text/{item}/update', 'update')
                            ->name('admin.text.update');

                        Route::get('/admin/text/{item}/detail', 'detail')
                            ->name('admin.text.detail');

                        Route::delete('/admin/text/{item}/destroy', 'destroy')
                            ->name('admin.text.destroy');

                        Route::get('/admin/text/index', 'index')
                            ->name('admin.text.index');
                    });

            });
    }
}
