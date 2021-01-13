<?php

namespace MichaelDojcar\LaravelAdmin\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AdminServiceProvider
 *
 * @package MichaelDojcar\LaravelAdmin\Providers
 */
class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admin.php', 'admin');
    }

    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Publish config
        $this->publishConfig();
    }

    private function publishConfig()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../config/admin.php' => config_path('admin.php'),
            ], 'config');

        }
    }
}