<?php

namespace Jamesclark32\LaravelWebsocket\WebsocketRouteResolvers;

use  Jamesclark32\LaravelWebsocket\WebsocketController;
use  Jamesclark32\LaravelWebsocket\WebsocketRequest;
use  Jamesclark32\LaravelWebsocket\WebsocketRoute;

class WebsocketClassRouteResolver implements WebsocketRouteResolverInterface
{
    public function resolve(WebsocketRoute $route, WebsocketRequest $websocketRequest)
    {
        $class = $route->getClass();
        $instance = app($class);

        if ($instance instanceof WebSocketController) {
            $instance->setWebsocketRequest($websocketRequest);
        }

        $method = $route->getMethod();

        return $instance->$method();
    }
}
