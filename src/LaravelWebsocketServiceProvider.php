<?php

namespace Jamesclark32\LaravelWebsocket;

use Jamesclark32\LaravelWebsocket\Commands\LaravelWebsocketCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelWebsocketServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-websocket')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_websocket_table')
            ->hasCommand(LaravelWebsocketCommand::class);
    }
}
