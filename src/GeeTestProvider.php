<?php

namespace Lambq\GeeTest;

use Illuminate\Support\ServiceProvider;

class GeeTestProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('captcha',function(){
            return new GeeCaptcha(config('lamb.id'),config('lamb.key'));
        });
    }
}
