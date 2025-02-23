<?php

namespace App\Commands; // Ensure the namespace is correct

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\WebSocket\WebSocketServer;

class StartWebSocketServer extends BaseCommand // Ensure the class name is unique
{
    protected $group       = 'WebSocket';
    protected $name        = 'websocket:serve';
    protected $description = 'Starts the WebSocket server using Workerman.';

    public function run(array $params)
    {
        $port = $params[0] ?? 8080;

        CLI::write("Starting WebSocket server on port {$port}...", 'green');

        // Instantiate and start the WebSocket server
        $webSocketServer = new WebSocketServer();
        $webSocketServer->start($port);
    }
}
