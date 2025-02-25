<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TripsModel;   
use App\Models\DriverModel;  

class Socket extends Controller
{
    protected $tripsModel;
    protected $driverModel;

    public function __construct()
    {
        // Initialize models
        $this->tripsModel = new TripsModel();
        $this->driverModel = new DriverModel();
    }

    public function hello(){
        return "Hello";
    }
    public function UpdateWsID()
    {
        $client_id = $this->request->getPost('client_id');
        $hash = $this->request->getPost('hash');

        $this->driverModel->update($hash, ['ws_id' => $client_id]);
    }

    public function getDriverTrips($hash)
    {
        $driver = $this->driverModel->where('hash', $hash)->first();

        if ($driver) {
            $driverID = $driver['id'];
            $trips = $this->tripsModel->where('driver_id', $driverID)->findAll();
            return $this->response->setJSON($trips);
        } else {
            return $this->response->setJSON(['error' => 'Driver not found']);
        }
    }
    
}
