<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\ServiceProvider;
use JamesClark32\LaravelWebsocket\Commands\LaravelWebsocketServeCommand;

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
            __DIR__.'/../routes/websocket.php' => base_path('routes/'),
        ]);
    }
}
