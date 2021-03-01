<?php

namespace JamesClark32\LaravelWebsocket;

use GuzzleHttp\Psr7\Header;
use Illuminate\Auth\Authenticatable;
use Illuminate\Encryption\Encrypter;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;
use JamesClark32\LaravelWebsocket\WebsocketRouteResolvers\WebsocketRouteResolver;
use JamesClark32\Websocket\WebsocketDirectorBase;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class WebsocketDirector extends WebsocketDirectorBase
{
    protected array $connections = [];
    protected ?Encrypter $encryptor;
    protected ?WebsocketRouteResolver $websocketRouteResolver;
    protected ?WebsocketRouteManager $websocketRoutesManager;

    public function __construct(?Encrypter $encryptor = null)
    {
        if (! $encryptor) {
            $encryptor = app(Encrypter::class);
        }

        $this->encryptor = $encryptor;

        $this->websocketRouteResolver = new WebsocketRouteResolver();
        $this->websocketRoutesManager = new WebsocketRouteManager();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $userId = $this->fetchUserIdFromSession($conn);

        $this->connections[$this->fetchResourceIdFromConnection($conn)] = [
            'connection' => $conn,
            'user_id' => $userId,
        ];
    }

    public function onClose(ConnectionInterface $conn)
    {
        $disconnectedId = $this->fetchResourceIdFromConnection($conn);
        unset($this->connections[$disconnectedId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $userId = $this->fetchUserIdFromSession($conn);
        $resourceId = $this->fetchResourceIdFromConnection($conn);
        unset($this->connections[$resourceId]);
        $conn->close();

        //@TODO log error
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        $resourceId = $this->fetchResourceIdFromConnection($conn);

        $websocketRequest = new WebsocketRequest();//@TODO: replace with factor
        $websocketRequest->setUserId($this->connections[$resourceId]['user_id']);

        $messageBody = json_decode($msg);
        $websocketRequest->setBody(collect((array) $messageBody));

        $websocketRequest->setRoute($messageBody->route);
        $websocketRequest->setHeaders(collect($conn->httpRequest->getHeaders()));

        $route = $this->websocketRoutesManager->get($websocketRequest->getRoute());
        if (!$route) {
            $this->sendToUser($this->connections[$resourceId]['user_id'], 'Route not found '.$messageBody->route);
        }

        $this->websocketRouteResolver->resolve($route, $websocketRequest);
    }

    public function sendToAll(string $message)
    {
        foreach ($this->connections as $connection) {
            $connection['connection']->send($message);
        }
    }

    public function sendToUser($user, string $message)
    {
        $this->sendToUsers([$user], $message);
    }

    public function sendToUsers(array $users, string $message)
    {
        $userIds = [];
        foreach ($users as $user) {
            if (is_int($user)) {
                $userIds[] = $user;
            }

            if (is_a(Authenticatable::class, $user)) {
                $userIds[] = $user->id;
            }
        }

        foreach ($this->connections as $connection) {
            if (in_array($connection['user_id'], $userIds)) {
                $connection['connection']->send($message);
            }
        }
    }

    protected function fetchUserIdFromSession(ConnectionInterface $conn)
    {
        $sessionId = $this->getCookieValueFromConnectionInterface($conn, Session::getName());
        $session = $this->buildSession($sessionId);
        $userId = $session->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        return $userId;
    }

    protected function getCookieValueFromConnectionInterface(ConnectionInterface $connection, string $name): ?string
    {
        $cookiesRaw = $connection->httpRequest->getHeader('Cookie');

        if (count($cookiesRaw)) {
            $cookiesArr = Header::parse($cookiesRaw)[0]; // Array of cookies

            $data = $cookiesArr[$name];
            if (! $data) {
                return null;
            }
            $data = substr($data, 0, -3);//strip trailing %3D TODO do this more cleanly
            $value = $this->encryptor->decryptString($data);
            $pieces = explode('|', $value);//@TODO: Why? And handle this more

            return $pieces[1];
        }
    }

    protected function buildSession(string $sessionId)
    {
        $sessionManager = app(SessionManager::class);
        $session = $sessionManager->driver();
        $session->setId($sessionId);
        $session->start();

        return $session;
    }

    /**
     * Returns the resource id from the connection, if it exists
     * Returns null otherwise
     *
     * @param  ConnectionInterface  $connection
     *
     * @return string|int
     */
    protected function fetchResourceIdFromConnection(ConnectionInterface $connection)
    {
        return $connection->resourceId;

        //@TODO: this doesn't seem to work. The above must use some magic methods to resolve.
//        if (property_exists($connection, 'resourceId')) {
//            $objectProperties = get_object_vars($connection);
//
//            return $objectProperties['resourceId'];
//        }
//
//        return count($this->connections);
    }
}
