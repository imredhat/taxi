<?php

namespace App\Controllers\API;

use App\Controllers\Request;
use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;
use App\Models\RequestModel;
use App\Models\TypeModel;
use App\Models\TripsModel;
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



    public function TripsList()
    {
        $hash = $this->request->getPost('hash');
        $carID = $this->request->getPost('carID');

        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        $CarModel = new CarModel();
        $cars = $CarModel->where(['cid' => $carID, 'active' => 1])->orderBy('active', 'desc')->first();


        if (!$cars) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ خودروی فعالی برای این راننده یافت نشد'], 404);
        }

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        $driverID = $driver['did'];
        $type_class = $cars['type_class'];


        // print_r($cars);
        // die();

        $PackagesModel = new \App\Models\PackagesModel();
        $type_class_name = $PackagesModel->where('id', $type_class)->first();

        // echo $type_class_name['name'];
        // die();


        $TripsModel = new TripsModel();
        $trips = $TripsModel->getNewRequest($type_class_name['name']);

        if (!$trips || empty($trips)) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ سفری یافت نشد'], 404);
        }

        return $this->respond(['status' => 'success', 'trips' => $trips]);
    }


    public function MyTrips()
    {
        $hash = $this->request->getPost('hash');
        $from_date = $this->request->getPost('from_date');
        $to_date = $this->request->getPost('to_date');

        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        $driverID = $driver['did'];


        $TripsModel = new TripsModel();
        if (!empty($from_date)) {
            $trips = $TripsModel->getMyRequest($driverID, $from_date, $to_date);
        } else {
            $trips = $TripsModel->getMyRequest($driverID);
        }


        if (!$trips || empty($trips)) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ سفری یافت نشد'], 404);
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

    public function Types()
    {

        $Types = new TypeModel();
        $AllTypes = $Types->orderBy('bid')->withDeleted()->findAll();

        if (!$AllTypes) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ تیپ خودرویی یافت نشد'], 404);
        }

        $TypeData = [];
        foreach ($AllTypes as $type) {
            $TypeData[] = [
                'id' => $type['bid'],
                'name' => $type['type_name'],
                'class' => $type['type_class'],
                'brand' => $type['type_brand'],
            ];
        }

        return $this->respond(['status' => 'success', 'types' => $TypeData]);
    }
}
