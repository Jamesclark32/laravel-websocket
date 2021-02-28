<?php

namespace Jamesclark32\LaravelWebsocket\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jamesclark32\LaravelWebsocket\LaravelWebsocketServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Jamesclark32\\LaravelWebsocket\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelWebsocketServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_laravel_websocket_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
