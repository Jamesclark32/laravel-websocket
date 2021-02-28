<?php

namespace Jamesclark32\LaravelWebsocket;

use Illuminate\Support\Collection;

class WebsocketRouteManager
{
    protected Collection $websocketRoutes;

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
        return $this->websocketRoutes->get($name)['action'];
    }
}
