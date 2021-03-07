<?php

namespace Jamesclark32\LaravelWebsocket;

use Illuminate\Support\Collection;

class WebsocketRouteManager
{
    protected Collection $websocketRoutes;
    private static $instance = null;

    private function __construct()
    {
        $this->websocketRoutes = new WebsocketRoutesCollection();
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return Collection
     */
    public function getWebsocketRoutes(): Collection
    {
        return $this->websocketRoutes;
    }

    /**
     * @param  string  $name
     * @param $action
     */
    public function add(string $name, $action)
    {
        $route = new WebsocketRoute();
        $route->setKey($name);
        
        $this->websocketRoutes->put($name, [
            'action' => $action,
        ]);
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
}
