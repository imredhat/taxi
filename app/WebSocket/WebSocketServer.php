<?php

namespace App\WebSocket;

use Workerman\Worker;
use PHPSocketIO\SocketIO;
use CodeIgniter\CodeIgniter;
use App\Controllers\ChatController;

class WebSocketServer
{
    protected $codeigniter;

    public function __construct()
    {
        // Initialize CodeIgniter
        $config = new \Config\App();
        $this->codeigniter = new CodeIgniter($config);
        $this->codeigniter->initialize();
    }

    public function start($port = 2021)
    {
        // Create a Socket.IO server
        $io = new SocketIO($port);

        // Event when a client connects
        $io->on('connection', function ($socket) {
            echo "New client connected: {$socket->id}\n";

            // Event when a client sends a message
            $socket->on('chat message', function ($message) use ($socket) {
                echo "Received message: $message\n";

                // Use CodeIgniter's controller and models
                $response = $this->handleMessage($message);

                // Broadcast the response to all clients
                $socket->broadcast->emit('chat message', $response);
            });

            // Event when a client disconnects
            $socket->on('disconnect', function () use ($socket) {
                echo "Client disconnected: {$socket->id}\n";
            });
        });

        // Run the worker
        Worker::runAll();
    }

    protected function handleMessage($message)
    {
        // Load CodeIgniter's services
        $request = \Config\Services::request();
        $response = \Config\Services::response();

        // Simulate a controller method call
        $controller = new \App\Controllers\ChatController($request, $response);
        return $controller->processMessage($message);
    }
}