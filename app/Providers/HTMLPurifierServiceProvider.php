<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HTMLPurifierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('htmlpurifier', function ($app) {
            return new \HTMLPurifier(\HTMLPurifier_Config::createDefault());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
