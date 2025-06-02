<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function() {
                Route::get('/', HomeController::class)->name('home');

                Route::resource('/admin/download', DownloadController::class)
                    ->only(['store','update','destroy'])
                    ->name('destroy', 'admin.download.destroy');
            });

        Route::get('/thumbnail/{dir}/{method}/{size}/{file}', ThumbnailController::class)
            ->name('thumbnail');
    }
}
