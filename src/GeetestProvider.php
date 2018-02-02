<?php

namespace Lamb\GeeTest;

use Illuminate\Support\ServiceProvider;

class GeetestProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config/lamb.php' => config_path('lamb.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
