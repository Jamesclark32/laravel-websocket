<?php

namespace JamesClark32\LaravelWebsocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JamesClark32\LaravelWebsocket\LaravelWebsocket
 */
class WebsocketMessenger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'websocket-messenger';
    }
}
