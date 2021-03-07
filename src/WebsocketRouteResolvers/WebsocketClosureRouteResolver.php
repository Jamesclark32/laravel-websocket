<?php

namespace JamesClark32\LaravelWebsocket\WebsocketRouteResolvers;

use JamesClark32\LaravelWebsocket\WebsocketRequest;
use JamesClark32\LaravelWebsocket\WebsocketRoute;

class WebsocketClosureRouteResolver implements WebsocketRouteResolverInterface
{
    public function resolve(WebsocketRoute $route, WebsocketRequest $websocketRequest)
    {
        $closure = $route->getClosure();

        return $closure($websocketRequest);
    }
}
