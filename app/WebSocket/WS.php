<?php
use Workerman\Worker;
use Workerman\Lib\Timer;
use GatewayWorker\Gateway;
use GatewayWorker\BusinessWorker;
use GatewayWorker\Register;

require_once __DIR__ . '/../../vendor/autoload.php';

// Register service
$register = new Register('text://0.0.0.0:1236');

// WebSocket Gateway
$gateway = new Gateway("websocket://0.0.0.0:2021");
$gateway->name = 'WebSocketGateway';
$gateway->count = 4;
$gateway->registerAddress = '127.0.0.1:1236';

// Business logic handler
$worker = new BusinessWorker();
$worker->name = 'WebSocketWorker';
$worker->count = 4;
$worker->registerAddress = '127.0.0.1:1236';

// Define business logic for handling messages
$worker->onMessage = function ($connection, $data) {
    echo "Received message: $data\n";
    $connection->send("Echo: $data");
};

// Run all services
Worker::runAll();
