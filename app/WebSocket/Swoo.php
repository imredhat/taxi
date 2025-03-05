<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;

// ایجاد یک سرور WebSocket روی پورت 9501
$server = new Server("0.0.0.0", 9501);

// رویداد اتصال جدید
$server->on("start", function (Server $server) {
    echo "WebSocket Server is started at ws://127.0.0.1:9501\n";
});

// رویداد اتصال کلاینت
$server->on('open', function (Server $server, Swoole\Http\Request $request) {
    echo "Connection open: {$request->fd}\n";
});

// رویداد دریافت پیام از کلاینت
$server->on('message', function (Server $server, Frame $frame) {
    echo "Received message: {$frame->data}\n";

    // ارسال پیام به کلاینت
    $server->push($frame->fd, "Server received: {$frame->data}");
});

// رویداد بسته شدن اتصال
$server->on('close', function (Server $server, int $fd) {
    echo "Connection closed: {$fd}\n";
});

// شروع سرور
$server->start();