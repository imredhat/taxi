<?php

namespace App\WebServer;

use Workerman\Worker;
use Workerman\Protocols\Http\Request;
use Workerman\Connection\TcpConnection;

class WebServer
{
    public function start($port = 2222)
    {
        // Create an HTTP worker
        $httpWorker = new Worker("http://0.0.0.0:$port");

        // Set the number of processes (optional)
        $httpWorker->count = 4;

        // Emitted when data is received
        $httpWorker->onMessage = function (TcpConnection $connection, Request $request) {
            // Handle the request and send a response
            $response = $this->handleRequest($request);
            $connection->send($response);
        };

        // Run the worker
        Worker::runAll();
    }

    protected function handleRequest(Request $request)
    {
        // Parse the request path
        $path = $request->path();

        // Example routing
        if ($path === '/') {
            return $this->homePage();
        } elseif ($path === '/about') {
            return $this->aboutPage();
        } else {
            return $this->notFoundPage();
        }
    }

    protected function homePage()
    {
        return "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n<h1>Welcome to the Home Page</h1>";
    }

    protected function aboutPage()
    {
        return "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n<h1>About Us</h1>";
    }

    protected function notFoundPage()
    {
        return "HTTP/1.1 404 Not Found\r\nContent-Type: text/html\r\n\r\n<h1>404 - Page Not Found</h1>";
    }
}