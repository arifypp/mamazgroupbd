<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Backend\PlatformSettings;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Fetch the Site Settings object
            $site_settings = PlatformSettings::all();
            View::share('site_settings', $site_settings);
    }
}
