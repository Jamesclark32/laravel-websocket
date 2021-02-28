<?php

namespace Jamesclark32\LaravelWebsocket;

class WebsocketRoute
{
    protected ?\Closure $closure = null;
    protected ?string $class;
    protected ?string $key;
    protected ?string $method;
    protected ?string $route;
    protected array $definition;

    /**
     * @param  mixed|string|null  $class
     *
     * @return WebsocketRoute
     */
    public function setClass(?string $class): WebsocketRoute
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @param  string|null  $key
     *
     * @return WebsocketRoute
     */
    public function setKey(?string $key): WebsocketRoute
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param  mixed|string|null  $method
     *
     * @return WebsocketRoute
     */
    public function setMethod(?string $method): WebsocketRoute
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param  string|null  $route
     *
     * @return WebsocketRoute
     */
    public function setRoute(?string $route): WebsocketRoute
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @param  array  $definition
     *
     * @return WebsocketRoute
     */
    public function setDefinition(array $definition): WebsocketRoute
    {
        $this->definition = $definition;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @return mixed|string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getDefinition(): array
    {
        return $this->definition;
    }

    /**
     * @return mixed|string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return \Closure|null
     */
    public function getClosure(): ?\Closure
    {
        return $this->closure;
    }

    /**
     * @param  \Closure|null  $closure
     *
     * @return WebsocketRoute
     */
    public function setClosure(?\Closure $closure): WebsocketRoute
    {
        $this->closure = $closure;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsClosure(): bool
    {
        return $this->closure instanceof \Closure;
    }

    /**
     * @return bool
     */
    public function getIsResolvableMethod(): bool
    {
        return $this->getClass() !== null && $this->getMethod() !== null;
    }

}
