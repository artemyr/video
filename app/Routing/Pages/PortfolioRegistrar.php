<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class PortfolioRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::controller(PortfolioController::class)
                    ->group(function () {
                        Route::get('/admin/portfolio', 'index')
                            ->name('admin.portfolio.index');

                        Route::delete('/admin/portfolio/{item}/destroy', 'destroy')
                            ->name('admin.portfolio.destroy');

                        Route::get('/admin/portfolio/create', 'pageCreate')
                            ->name('admin.portfolio.create.page');

                        Route::post('/admin/portfolio/create', 'create')
                            ->name('admin.portfolio.create');

                        Route::get('/admin/portfolio/{item}', 'detail')
                            ->name('admin.portfolio.detail');

                        Route::post('/admin/portfolio/{item}/update', 'update')
                            ->name('admin.portfolio.update');
                    });

            });
    }
}
