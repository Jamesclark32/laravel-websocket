<?php

namespace JamesClark32\LaravelWebsocket;

use Illuminate\Support\Collection;

class WebsocketRoutesCollection
{
    protected Collection $websocketRoutes;
    protected WebsocketRouteFactory $websocketRouteFactory;

    public function __construct(WebsocketRouteFactory $websocketRouteFactory)
    {
        $this->websocketRouteFactory = $websocketRouteFactory;
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

    public function loadWebsocketRoutes(): Collection
    {
        $path = base_path('routes/websocket.php');
        if (file_exists($path)) {
            $this->websocketRoutes = collect(include($path));
            $this->transformWebsocketRoutes();
        }

        return $this->websocketRoutes;
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
