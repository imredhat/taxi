<?php
namespace App\WebSocket;

use Workerman\Worker;
use Workerman\Connection\TcpConnection;

class WebSocketServer
{
    public function start($port = 9090)
    {
        // Create a WebSocket worker
        $wsWorker = new Worker("websocket://0.0.0.0:9090");

        // Set the number of processes (optional)
        $wsWorker->count = 4;

        // Emitted when a new connection is established
        $wsWorker->onConnect = function (TcpConnection $connection) {
            echo "New connection established\n";
        };

        // Emitted when data is received
        $wsWorker->onMessage = function (TcpConnection $connection, $data) {
            // Broadcast the message to all connected clients
            foreach ($connection->worker->connections as $client) {
                $client->send($data);
            }
        };

        // Emitted when a connection is closed
        $wsWorker->onClose = function (TcpConnection $connection) {
            echo "Connection closed\n";
        };

        // Run the worker
        Worker::runAll();
    }
}