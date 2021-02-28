<?php

namespace Jamesclark32\LaravelWebsocket\Commands;

use Illuminate\Console\Command;

class LaravelWebsocketCommand extends Command
{
    public $signature = 'laravel-websocket';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
