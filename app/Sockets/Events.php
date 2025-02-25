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

        if (isset($data['r']) && trim($data['r']) == 'Trips') {
            // $trips = self::getTripsFromDatabase($data['hash']);
            // Gateway::sendToClient($client_id, json_encode($trips));

            $host     = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:8080';
            $protocol = "http://";
            if (isset($_SERVER['HTTPS']) && ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
                $protocol = "https://";
            }

            $port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '80';

            // $url      = $protocol . $host . '/api/driver/TripsList';
            $url      = 'https://portal.pooyeshtak30.ir/api/driver/TripsList';
            $data     = ['hash' => $data['hash'], 'carID' => $data['carID'], 'url' => $url];
            $response = self::curlLink($url, $data);

            // Gateway::sendToClient($client_id, "HI");
            Gateway::sendToClient($client_id, $response);
        }
    }

    public static function onConnect($client_id)
    {
        echo "New client connected: $client_id\n";

        Gateway::sendToClient($client_id, json_encode([
            'type'      => 'client_id',
            'client_id' => $client_id,
        ]));
    }

    public static function onClose($client_id)
    {
        // echo "Client $client_id disconnected\n";
    }

    private static function getTripsFromDatabase($hash)
    {
        $host    = 'localhost';
        $db      = 'rep_taxi';
        $user    = 'root';
        $pass    = '';
        $charset = 'utf8mb4';

        $dsn     = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        $stmt = $pdo->query('SELECT * FROM trips');
        return $stmt->fetchAll();
    }

    private static function curlLink($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }

    private static function getLinkWithData($url, $data)
    {
        $client   = \Config\Services::curlrequest();
        $response = $client->post($url, [
            'form_params' => $data,
        ]);

        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        } else {
            throw new Exception('Unexpected HTTP status: ' . $response->getStatusCode() . ' ' . $response->getReason());
        }
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
