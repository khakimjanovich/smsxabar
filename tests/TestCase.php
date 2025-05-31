<?php

namespace Khakimjanovich\SMSXabar\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Khakimjanovich\SMSXabar\SMSXabarServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('smsxabar.endpoint', 'https://fake-smsxabar.test/send');
        $app['config']->set('smsxabar.username', 'demo-user');
        $app['config']->set('smsxabar.password', 'demo-password');
    }

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'Khakimjanovich\\SMSXabar\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            SMSXabarServiceProvider::class,
        ];
    }
}
