<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Facebook;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(Facebook::class, function () {
            return new Facebook();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}