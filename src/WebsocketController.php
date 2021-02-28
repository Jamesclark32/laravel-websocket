<?php

namespace Jamesclark32\LaravelWebsocket;

class WebsocketController
{
    protected WebsocketRequest $websocketRequest;

    /**
     * @return WebsocketRequest
     */
    public function getWebsocketRequest(): WebsocketRequest
    {
        return $this->websocketRequest;
    }

    /**
     * @param  WebsocketRequest  $websocketRequest
     *
     * @return WebsocketController
     */
    public function setWebsocketRequest(WebsocketRequest $websocketRequest): WebsocketController
    {
        $this->websocketRequest = $websocketRequest;

        return $this;
    }
}
