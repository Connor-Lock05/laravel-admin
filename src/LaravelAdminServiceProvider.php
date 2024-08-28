<?php

namespace ConnorLock05\LaravelAdmin;

use ConnorLock05\LaravelAdmin\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class LaravelAdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/admin'),
        ], 'admin-views');

        $this->publishes([
            __DIR__.'/config' => config_path(),
        ], 'admin-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/laravel-admin.php', 'laravel-admin');
    }
}