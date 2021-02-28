<?php

namespace Jamesclark32\LaravelWebsocket;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;

class WebsocketRequest
{
    protected Collection $body;
    protected Collection $headers;
    protected ?User $user = null;
    protected int $userId;
    protected string $route;

    /**
     * @return User
     */
    public function getUser(): User
    {
        if (!$this->user && $this->userId) {
            $this->user = User::findOrFail($this->userId);
        }

        return $this->user;
    }

    /**
     * @param  User  $user
     *
     * @return WebsocketRequest
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getBody(): Collection
    {
        return $this->body;
    }

    /**
     * @param  Collection  $body
     *
     * @return WebsocketRequest
     */
    public function setBody(Collection $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function get($name)
    {
        return $this->body->get($name);
    }

    /**
     * @param  int  $userId
     *
     * @return WebsocketRequest
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param  string  $route
     *
     * @return WebsocketRequest
     */
    public function setRoute(string $route): self
    {
        $this->route = $route;
        return $this;
}

    /**
     * @return Collection
     */
    public function getHeaders(): Collection
    {
        return $this->headers;
    }

    /**
     * @param  Collection  $headers
     *
     * @return WebsocketRequest
     */
    public function setHeaders(Collection $headers): self
    {
        $this->headers = $headers;
        return $this;
}
}
