<?php
use Workerman\Worker;
use GatewayWorker\BusinessWorker;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/Events.php'; // Load the event handler class

// Business Worker
$worker = new BusinessWorker();
$worker->name = 'WebSocketWorker';
$worker->count = 1; // Windows supports only 1 process
$worker->registerAddress = '127.0.0.1:1236';

// Assign event handler
$worker->eventHandler = 'Events';

// Run Worker
Worker::runAll();
