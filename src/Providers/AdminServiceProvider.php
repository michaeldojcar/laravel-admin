<?php

namespace MichaelDojcar\LaravelAdmin\Providers;

use Illuminate\Support\ServiceProvider;
use MichaelDojcar\LaravelAdmin\Admin;
use MichaelDojcar\LaravelAdmin\Console\UserSeedCommand;


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

        // Admin facade
        $this->app->bind('admin', function ($app) {
            return new Admin();
        });
    }

    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Publish config
        $this->publishConfig();

        // Views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
    }

    private function publishConfig()
    {
        if ($this->app->runningInConsole()) {

            // Register commands
            $this->commands([
                UserSeedCommand::class,
            ]);

            // Publish config
            $this->publishes([
                __DIR__ . '/../../config/admin.php' => config_path('admin.php'),
            ], 'config');

            // Publish assets
            $this->publishes([
                __DIR__ . '/../../resources/css/app.css' => public_path('vendor/admin/css/app.css'),
            ], 'assets');

            // Publish views
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/admin'),
            ], 'views');

        }
    }
}