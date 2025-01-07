<?php

namespace App\Controllers\API;

use App\Controllers\Request;
use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;
use App\Models\RequestModel;
use CodeIgniter\RESTful\ResourceController;

class Driver extends ResourceController
{

    public function Cars()
    {
        $hash = $this->request->getPost('hash');

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => 'شناسه یا هش راننده نامعتبر است'], 401);
        }

        $driverId = $driver['did'];
        $CarModel = new CarModel();
        $cars = $CarModel->where('driver_id', $driverId)->findAll();

        if (!$cars) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ خودرویی برای این راننده یافت نشد'], 404);
        }

        $carsData = [];
        foreach ($cars as $car) {
            $carsData[] = [
                'car_id' => $car['cid'],
                'driver_id' => $car['driver_id'],
                'brand' => $car['brand'],
                'fuel' => $car['fuel'],           
                'pelak' => $car['iran'] . ' ' . $car['pelak'] . ' ' . $car['harf'] . ' ' . $car['pelak_last'],
                'motor' => $car['motor'],
                'pic_back' => $car['pic_back'],
                'pic_front' => $car['pic_front'],
                'pic_in_back' => $car['pic_in_back'],
                'pic_in_front' => $car['pic_in_front'],
                'shasi' => $car['shasi'],
                'type' => $car['type'],
                'vin' => $car['vin'],
            ];
        }

        return $this->respond(['status' => 'success', 'cars' => $cars]);

    }

    public function NewService(){
        $hash = $this->request->getPost('hash');
        $carID = $this->request->getPost('carID');        

        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();
        $driverID = $driver['did'];

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }
      
        $Request = new RequestModel();
        $trips = $Request->getNewRequest($driverID, $carID);

        if (!$trips) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ سفری فعالی یافت نشد'], 404);
        }

        return $this->respond(['status' => 'success', 'trips' => $trips]);


    }

    public function Brands()
    {
        $BrandModel = new BrandModel();
        $brands = $BrandModel->orderBy('brand')->withDeleted()->findAll();

        if (!$brands) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ برندی یافت نشد'], 404);
        }

        $brandsData = [];
        foreach ($brands as $brand) {
            $brandsData[] = [
                'id' => $brand['TiD'],
                'name' => $brand['brand'],
            ];
        }

        return $this->respond(['status' => 'success', 'brands' => $brandsData]);
    }

}
