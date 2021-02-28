<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JamesClark32\LaravelWebsocket\LaravelWebsocket
 */
class LaravelWebsocketRouteFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'websocket-route-manager';
    }
}
