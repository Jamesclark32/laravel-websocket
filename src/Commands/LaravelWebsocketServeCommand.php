<?php

namespace JamesClark32\LaravelWebsocket\Commands;

use Illuminate\Console\Command;
use JamesClark32\LaravelWebsocket\WebsocketDirector;
use JamesClark32\Websocket\WebsocketServer;

class LaravelWebsocketServeCommand extends Command
{
    protected $signature = 'websocket:serve';
    protected WebsocketDirector $websocketDirector;
    protected WebsocketServer $websocketServer;
    public $description = 'Starts the long-running websocket server process';

    public function __construct(WebsocketDirector $websocketDirector, WebsocketServer $websocketServer)
    {
        $this->websocketDirector = $websocketDirector;
        $this->websocketServer = $websocketServer;
        parent::__construct();
    }

    public function handle()
    {
        $this->output->writeln('Starting WebSocket listener.');

        $this->websocketServer
            ->setWebsocketDirector($this->websocketDirector)
            ->start();
    }
}
