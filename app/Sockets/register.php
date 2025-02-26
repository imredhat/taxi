<?php
use Workerman\Worker;
use GatewayWorker\Register;

require_once __DIR__ . '/../../vendor/autoload.php';

// Start Register Server
$register = new Register('text://0.0.0.0:6321');

// Run Worker
Worker::$daemonize = false; // اجرای Workerman در حالت غیر Daemon

Worker::runAll();
