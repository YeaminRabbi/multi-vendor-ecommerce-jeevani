<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Frontend;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('FrontendHelper', Frontend::class);
            $view->with('Media', function ($file){
                return Frontend::filePath($file);
            });
        });
    }
}
