<?php

namespace Jamesclark32\LaravelWebsocket\WebsocketRouteResolvers;

use Jamesclark32\LaravelWebsocket\WebsocketRequest;
use Jamesclark32\LaravelWebsocket\WebsocketRoute;

class WebsocketRouteResolver
{
    public function resolve(WebsocketRoute $route, WebsocketRequest $websocketRequest)
    {
        if ($route->getIsClosure()) {
            $resolver = new WebsocketClosureRouteResolver();

            return $resolver->resolve($route, $websocketRequest);
        }

        if ($route->getIsResolvableMethod()) {
            $resolver = new WebsocketClassRouteResolver();

            return $resolver->resolve($route, $websocketRequest);
        }
    }
}
