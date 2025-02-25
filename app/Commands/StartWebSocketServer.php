<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\WebSocket\WebSocketServer;

class StartWebSocketServer extends BaseCommand
{
    protected $group       = 'WebSocket';
    protected $name        = 'websocket:serve';
    protected $description = 'Starts the WebSocket server using Socket.IO and Workerman.';

    public function run(array $params)
    {
        $port = $params[0] ?? 2021;

        CLI::write("Starting WebSocket server on port {$port}...", 'green');

        // Instantiate and start the WebSocket server
        $webSocketServer = new WebSocketServer();
        $webSocketServer->start($port);
    }
}