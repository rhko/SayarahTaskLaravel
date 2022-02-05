<?php

namespace App\Providers;

// use App\Google\DriveContainer;

use App\Google\DriveContainer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DriveContainer::class, function () {
            return new DriveContainer('client_secret.json');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $driveContainer = $this->app->make(DriveContainer::class);
    }
}
