<?php

namespace Jamesclark32\LaravelWebsocket;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jamesclark32\LaravelWebsocket\LaravelWebsocket
 */
class LaravelWebsocketMessengerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'websocket-messanger';
    }
}
