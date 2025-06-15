<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::get('/admin', function () {
                    return view('admin.index');
                })->name('admin.index');

                Route::get('/admin/main', function() {
                    return view('admin.main.index');
                })->name('admin.main');

                Route::get('/admin/media', [MediaController::class, 'page'])
                    ->name('admin.media');

                Route::controller(SettingsController::class)
                    ->group(function () {
                        Route::get('/admin/settings/add', 'pageCreate')
                            ->name('admin.settings.create.page');

                        Route::post('/admin/settings/add', 'create')
                            ->name('admin.settings.create');

                        Route::post('/admin/settings/{setting}/update', 'update')
                            ->name('admin.settings.update');

                        Route::get('/admin/settings/{setting}/detail', 'detail')
                            ->name('admin.settings.detail');

                        Route::delete('/admin/settings/{setting}/destroy', 'destroy')
                            ->name('admin.settings.destroy');

                        Route::get('/admin/settings/index', 'index')
                            ->name('admin.settings.index');
                    });

                Route::controller(TextController::class)
                    ->group(function () {
                        Route::get('/admin/text/add', 'pageCreate')
                            ->name('admin.text.create.page');

                        Route::post('/admin/text/add', 'create')
                            ->name('admin.text.create');

                        Route::post('/admin/text/{text}/update', 'update')
                            ->name('admin.text.update');

                        Route::get('/admin/text/{text}/detail', 'detail')
                            ->name('admin.text.detail');

                        Route::delete('/admin/text/{text}/destroy', 'destroy')
                            ->name('admin.text.destroy');

                        Route::get('/admin/text/index', 'index')
                            ->name('admin.text.index');
                    });

                Route::controller(MediaController::class)
                    ->group(function () {
                        Route::get('/admin/media', 'page')->name('admin.media.index');
                        Route::get('/admin/media/list', 'handle')->name('admin.media.list');
                    });

                Route::controller(SliderController::class)
                    ->group(function () {
                        Route::get('/admin/main/slider', 'index')
                            ->name('admin.main.slider.index');

                        Route::delete('/admin/main/slider/{slider}/destroy', 'destroy')
                            ->name('admin.main.slider.destroy');

                        Route::get('/admin/main/slider/create', 'create')
                            ->name('admin.main.slider.create');

                        Route::get('/admin/main/slider/{slider}', 'detail')
                            ->name('admin.main.slider.detail');

                        Route::post('/admin/main/slider/{slider}/update', 'update')
                            ->name('admin.main.slider.update');
                    });

                Route::controller(PortfolioController::class)
                    ->group(function () {
                        Route::get('/admin/portfolio', 'index')
                            ->name('admin.portfolio.index');

                        Route::delete('/admin/portfolio/{item}/destroy', 'destroy')
                            ->name('admin.portfolio.destroy');

                        Route::get('/admin/portfolio/add', 'pageCreate')
                            ->name('admin.portfolio.create.page');

                        Route::get('/admin/portfolio/create', 'create')
                            ->name('admin.portfolio.create');

                        Route::get('/admin/portfolio/{item}', 'detail')
                            ->name('admin.portfolio.detail');

                        Route::post('/admin/portfolio/{item}/update', 'update')
                            ->name('admin.portfolio.update');
                    });

            });
    }
}
