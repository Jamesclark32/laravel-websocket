<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\ServiceProvider;
use JamesClark32\LaravelWebsocket\Commands\LaravelWebsocketServeCommand;
use JamesClark32\Websocket\WebsocketMessenger;

class LaravelWebsocketServiceProvider extends ServiceProvider
{
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
        ]);

        $this->app->bind('websocket-messenger', function ($app) {
            return new WebsocketMessenger();
        });


        $this->app->singleton('websocket-route-collection', function ($app) {
            return new WebsocketRoutesCollection();
        });
    }
}
