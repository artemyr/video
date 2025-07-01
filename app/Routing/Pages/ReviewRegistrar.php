<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ReviewRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function () {

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
            });
    }
}
