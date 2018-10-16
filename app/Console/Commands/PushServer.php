<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;
use Ratchet\Wamp\WampServer;
use App\Classes\Socket\Pusher;

class PushServer extends Command
{
    protected $signature = 'socketpusher:start';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
       $loop = ReactLoop::create();
       $context = new ReactContext($loop);

       $pusher = new Pusher();

       $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
       $pull->bind('tcp://127.0.0.1:5555');
       $pull->on('message', array($pusher, 'broadcast'));


        // Set up our WebSocket server for clients wanting real-time updates
        $webSock = new ReactServer('0.0.0.0:8080',$loop);

        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );
        $this->info('Run');
        $loop->run();
    }
}
