<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ReviewController;
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

                Route::controller(MediaController::class)
                    ->group(function () {
                        Route::get('/admin/media', 'page')->name('admin.media.index');
                        Route::get('/admin/media/list', 'handle')->name('admin.media.list');
                    });

                Route::controller(SliderController::class)
                    ->group(function () {
                        Route::get('/admin/main/slider', 'index')
                            ->name('admin.main.slider.index');

                        Route::delete('/admin/main/slider/{item}/destroy', 'destroy')
                            ->name('admin.main.slider.destroy');

                        Route::get('/admin/main/slider/create', 'pageCreate')
                            ->name('admin.main.slider.create.page');

                        Route::post('/admin/main/slider/create', 'create')
                            ->name('admin.main.slider.create');

                        Route::get('/admin/main/slider/{item}', 'detail')
                            ->name('admin.main.slider.detail');

                        Route::post('/admin/main/slider/{item}/update', 'update')
                            ->name('admin.main.slider.update');
                    });

                Route::controller(ReviewController::class)
                    ->group(function () {
                        Route::get('/admin/review', 'index')
                            ->name('admin.review.index');

                        Route::delete('/admin/review/{item}/destroy', 'destroy')
                            ->name('admin.review.destroy');

                        Route::get('/admin/review/create', 'pageCreate')
                            ->name('admin.review.create.page');

                        Route::post('/admin/review/create', 'create')
                            ->name('admin.review.create');

                        Route::get('/admin/review/{item}', 'detail')
                            ->name('admin.review.detail');

                        Route::post('/admin/review/{item}/update', 'update')
                            ->name('admin.review.update');
                    });

                Route::controller(PriceController::class)
                    ->group(function () {
                        Route::get('/admin/price', 'index')
                            ->name('admin.price.index');

                        Route::delete('/admin/price/{item}/destroy', 'destroy')
                            ->name('admin.price.destroy');

                        Route::get('/admin/price/create', 'pageCreate')
                            ->name('admin.price.create.page');

                        Route::post('/admin/price/create', 'create')
                            ->name('admin.price.create');

                        Route::get('/admin/price/{item}', 'detail')
                            ->name('admin.price.detail');

                        Route::post('/admin/price/{item}/update', 'update')
                            ->name('admin.price.update');
                    });

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

                Route::controller(HomeController::class)
                    ->group(function () {
                        Route::get('/admin/main', 'page')
                            ->name('admin.main.index');
                        Route::post('/admin/main/save', 'handle')
                            ->name('admin.main.save');
                    });

                Route::controller(ContactsController::class)
                    ->group(function () {
                        Route::get('/admin/contacts', 'page')
                            ->name('admin.contacts.index');
                        Route::post('/admin/contacts/save', 'handle')
                            ->name('admin.contacts.save');
                    });
            });
    }
}
