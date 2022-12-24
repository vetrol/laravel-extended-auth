<?php

namespace YottaHQ\LaravelExtendedAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use YottaHQ\LaravelExtendedAuth\Drivers\ExtendedUserProvider;

class LaravelExtendedAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerPublishing();
        $this->registerAuthUserProvider();
    }

    public function register()
    {
        $this->registerServiceProvider();
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-extended-auth.php', 'laravel-extended-auth');
    }

    protected function registerRoutes(): void
    {
        if (LaravelExtendedAuth::$registersRoutes) {
            Route::group([
                'namespace' => 'LaravelExtendedAuth\Http\Controllers',
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
        }
    }

    protected function registerMigrations(): void
    {
        if (LaravelExtendedAuth::$runsMigrations && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_user_email_addresses_table.php' => database_path('migrations/'.date('Y-m-d_His').'_create_user_email_addresses_table.php'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/../config/laravel-extended-auth.php' => config_path('laravel-extended-auth.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../routes/web.php' => config_path('../routes/laravel-extended-auth.php'),
            ], 'routes');
        }
    }

    protected function registerServiceProvider(): void
    {
        if (LaravelExtendedAuth::$registersServiceProviders) {
            $this->app->register(LaravelExtendedAuthEventServiceProvider::class);
        }
    }

    protected function registerAuthUserProvider(): void
    {
        Auth::provider('laravelExtendedAuth', static function ($app, array $config) {
            return new ExtendedUserProvider($app->get('hash'), $config['model']);
        });
    }
}
