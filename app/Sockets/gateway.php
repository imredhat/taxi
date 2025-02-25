<?php
use Workerman\Worker;
use GatewayWorker\Gateway;

require_once __DIR__ . '/../../vendor/autoload.php';

// WebSocket Gateway
$gateway = new Gateway("websocket://0.0.0.0:2021");
$gateway->name = 'WebSocketGateway';
$gateway->count = 1; // Windows supports only 1 process
$gateway->registerAddress = '127.0.0.1:6321'; // Ensure this matches BusinessWorker

// Run Worker
Worker::runAll();
