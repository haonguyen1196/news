<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        //đăng kí paginate với bootstrap
        Paginator::useBootstrap();

        //cung cap setting cho toan bo view
        $setting = Setting::pluck('value', 'key')->toArray();

        view()->composer('*', function ($view) use($setting) {
            $view->with('setting', $setting);
        });
    }
}