<?php

namespace YottaHQ\LaravelExtendedAuth\Tests;

use YottaHQ\LaravelExtendedAuth\LaravelExtendedAuthServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelExtendedAuthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_user_email_addresses_table.php.stub';
        $migration->up();
        */
    }
}
