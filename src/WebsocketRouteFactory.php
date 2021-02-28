<?php

namespace Jamesclark32\LaravelWebsocket;

class WebsocketRouteFactory
{
    protected $key;
    protected $definition;

    public function createFromRouteDefinition(string $key, array $definition): WebsocketRoute
    {
        $websocketRoute = new WebsocketRoute();

        $websocketRoute->setKey($key)
            ->setDefinition($definition);

        if ($this->isClosure($definition['action'])) {
            return $websocketRoute->setClosure($definition['action'])
                ->setClass(null)
                ->setMethod(null);
        }

        if ($this->isClassMethod($definition['action'])) {
            return $websocketRoute->setClass($definition['action'][0])
                ->setMethod($definition['action'][1]);
        }

        if ($this->isInvokableClass($definition['action'])) {
            return $websocketRoute->setClass($definition['action'])
                ->setMethod('__invoke');
        }
    }

    protected function isClosure($action): bool
    {
        return $action instanceof \Closure;
    }

    protected function isClassMethod($action): bool
    {
        return is_array($action);//@TODO: check for class and method here?
    }

    protected function isInvokableClass($action): bool
    {
        return is_string($action);//@TODO: Check for class and method here?
    }
}
