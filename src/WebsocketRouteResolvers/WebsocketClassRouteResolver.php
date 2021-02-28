<?php

namespace JamesClark32\LaravelWebsocket\WebsocketRouteResolvers;

use  JamesClark32\LaravelWebsocket\WebsocketController;
use  JamesClark32\LaravelWebsocket\WebsocketRequest;
use  JamesClark32\LaravelWebsocket\WebsocketRoute;

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
