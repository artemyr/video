<?php

namespace App\Providers;

use App\View\Composers\AdminNavigationComposer;
use App\View\Composers\GlobalComposer;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn($asset) => $this->asset("resources/images/$asset"));

        View::composer('shared.menu', NavigationComposer::class);
        View::composer('*', GlobalComposer::class);
        View::composer('admin.*', AdminNavigationComposer::class);
    }
}
