<?php

namespace JamesClark32\LaravelWebsocket;

use JamesClark32\LaravelWebsocket\Commands\LaravelWebsocketServeCommand;
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
            ->hasCommand(LaravelWebsocketServeCommand::class);
    }
}
