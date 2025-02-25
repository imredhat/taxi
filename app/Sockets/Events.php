<?php

use GatewayWorker\Lib\Gateway;

class Events
{
    public static function onMessage($client_id, $message)
    {

        $data = json_decode($message, true);


        // if (isset($data['hash']) && isset($data['r']) && trim($data['r']) == 'UWS') {
        //     self::updateDriverWsId($client_id , $data['hash']);
        //     Gateway::sendToClient($client_id, "Driver ws_id updated");
        // }



        if (isset($data['hash']) && isset($data['r']) && trim($data['r']) == 'Trips') {
            $trips = self::getTripsFromDatabase($data['hash']);
            Gateway::sendToClient($client_id, json_encode($trips));
        }
    }

    public static function onConnect($client_id)
    {
        echo "New client connected: $client_id\n";


        Gateway::sendToClient($client_id, json_encode([
            'type' => 'client_id',
            'client_id' => $client_id
        ]));
    }

    public static function onClose($client_id)
    {
        // echo "Client $client_id disconnected\n";
    }

    private static function getTripsFromDatabase($hash)
    {
        $host = 'localhost';
        $db = 'rep_taxi';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $stmt = $pdo->query('SELECT * FROM trips');
        return $stmt->fetchAll();
    }



    // private static function updateDriverWsId($client_id, $hash)
    // {
    //     $host = 'localhost';
    //     $db = 'rep_taxi';
    //     $user = 'root';
    //     $pass = '';
    //     $charset = 'utf8mb4';

    //     $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    //     $options = [
    //         PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    //         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //         PDO::ATTR_EMULATE_PREPARES   => false,
    //     ];

    //     try {
    //         $pdo = new PDO($dsn, $user, $pass, $options);
    //     } catch (\PDOException $e) {
    //         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    //     }

    //     $stmt = $pdo->prepare('SELECT did FROM driver WHERE hash = :hash');
    //     $stmt->execute(['hash' => $driver_id]);
    //     $driver_id = $stmt->fetchColumn();

    //     $stmt = $pdo->prepare('UPDATE driver SET ws_id = :ws_id WHERE id = :driver_id');
    //     $stmt->execute(['ws_id' => $client_id, 'driver_id' => $driver_id]);
    // }
}
