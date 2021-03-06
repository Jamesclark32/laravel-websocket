<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\Collection;

class WebsocketRoutesCollection
{
    protected Collection $websocketRoutes;
    protected WebsocketRouteFactory $websocketRouteFactory;

    public function __construct(?WebsocketRouteFactory $websocketRouteFactory = null)
    {
        if ($websocketRouteFactory === null) {
            $websocketRouteFactory = new WebsocketRouteFactory();
        }
        $this->websocketRouteFactory = $websocketRouteFactory;

        $this->websocketRoutes = collect([]);
    }

    /*
     * This class is intended as a wrapper around a Collection
     * which adds some websocket rote specific functionality
     * the application of __call() is intended as a means
     * to allow methods to pass thru to the underlying
     * methods on the Collection instance and stuff
     */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->websocketRoutes, $name], $arguments);
    }

    /**
     * @param  string  $name
     * @param $action
     */
    public function add(string $name, $action)
    {
        $route = $this->transformWebsocketRoute($name, ['action' => $action]);

        $this->websocketRoutes->put($name, $route);
    }

    /**
     * @param  string  $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->websocketRoutes->get($name);
    }

    protected function transformWebsocketRoutes(): void
    {
        $this->websocketRoutes->transform(function ($value, $key) {
            return $this->transformWebsocketRoute($key, $value);
        });
    }

    protected function transformWebsocketRoute(string $key, array $value): WebsocketRoute
    {
        return $this->websocketRouteFactory->createFromRouteDefinition($key, $value);
    }
}
