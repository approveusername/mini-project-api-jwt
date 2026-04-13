<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomGreetingService;

class CustomGreetingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('custom-greeting', function ($app) {
            return new CustomGreetingService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
