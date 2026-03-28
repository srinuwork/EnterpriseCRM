<?php

namespace App\Providers;

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
        // Share admin portal settings globally with all views
        if (!app()->runningInConsole() && \Schema::hasTable('settings')) {
            \View::share('adminLoginEnabled', \App\Models\Setting::get('admin_login_enabled', '1') == '1');
            \View::share('adminRegisterEnabled', \App\Models\Setting::get('admin_register_enabled', '1') == '1');
        } else {
            \View::share('adminLoginEnabled', true);
            \View::share('adminRegisterEnabled', true);
        }
    }
}
