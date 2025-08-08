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
//        Route::middleware(['web', AdminMiddleware::class])
//            ->group(function () {
//
//                Route::get('/admin', function () {
//                    return view('admin.index');
//                })->name('admin.index');
//
//                Route::controller(HomeController::class)
//                    ->group(function () {
//
//                        Route::get('/admin/main', 'page')
//                            ->name('admin.main.index');
//
//                        Route::post('/admin/main/save', 'handle')
//                            ->name('admin.main.save');
//                    });
//
//                Route::controller(ContactsController::class)
//                    ->group(function () {
//
//                        Route::get('/admin/contacts', 'page')
//                            ->name('admin.contacts.index');
//
//                        Route::post('/admin/contacts/save', 'handle')
//                            ->name('admin.contacts.save');
//                    });
//
//                Route::get('/admin/test/livewire', function () {
//                    return view('admin.test.livewire');
//                });
//            });
    }
}
