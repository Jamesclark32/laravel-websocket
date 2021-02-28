<?php

namespace Jamesclark32\LaravelWebsocket\WebsocketRouteResolvers;

use Jamesclark32\LaravelWebsocket\WebsocketRequest;
use Jamesclark32\LaravelWebsocket\WebsocketRoute;

/**
 * Interface for a route resolver.
 * A route resolver is capable of resolving a route.
 * For example, a resolver for an invokable controller route
 * would be responsible for instantiating an instance of the controller
 * and executing it's __invoke() method.
 *
 * Interface WebsocketRouteResolverInterface
 *
 * @package Jamesclark32\LaravelWebsocket\WebsocketRouteResolvers
 */
interface WebsocketRouteResolverInterface
{
    public function resolve(WebsocketRoute $route, WebsocketRequest $websocketRequest);
}
