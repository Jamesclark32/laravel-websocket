<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\ServiceProvider;
use JamesClark32\LaravelWebsocket\Commands\LaravelWebsocketServeCommand;
use JamesClark32\Websocket\WebsocketMessenger;

class LaravelWebsocketServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-websocket.php',
            'laravel-websocket',
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LaravelWebsocketServeCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../routes/websocket.php' => base_path('routes/websocket.php'),
            __DIR__.'/../config/laravel-websocket.php' => config_path('laravel-websocket.php'),
        ]);

        $this->app->bind('websocket-messenger', function ($app) {
            return new WebsocketMessenger();
        });


        $this->app->singleton('websocket-route-collection', function ($app) {
            return new WebsocketRoutesCollection();
        });
    }
}
