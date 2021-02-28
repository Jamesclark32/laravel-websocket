<?php

namespace Jamesclark32\LaravelWebsocket\WebsocketRouteResolvers;

use Jamesclark32\LaravelWebsocket\WebsocketRequest;
use Jamesclark32\LaravelWebsocket\WebsocketRoute;

class WebsocketClosureRouteResolver implements WebsocketRouteResolverInterface
{
    public function resolve(WebsocketRoute $route, WebsocketRequest $websocketRequest)
    {
        $closure = $route->getClosure();

        return $closure();
    }
}
