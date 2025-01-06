<?php

namespace App\Controllers\API;

use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;
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
                'iran' => $car['iran'],
                'pelak' => $car['pelak'],
                'harf' => $car['harf'],
                'pelak_last' => $car['pelak_last'],
                'motor' => $car['motor'],
                'pic_back' => $car['pic_back'],
                'pic_front' => $car['pic_front'],
                'pic_in_back' => $car['pic_in_back'],
                'pic_in_front' => $car['pic_in_front'],
                'scan_govahiname' => $car['scan_govahiname'],
                'shasi' => $car['shasi'],
                'type' => $car['type'],
                'vin' => $car['vin'],
            ];
        }

        return $this->respond(['status' => 'success', 'cars' => $cars]);

    }

    public function NewService(){
        $hash = $this->request->getPost('hash');

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

      
        $NotificationModel = new \App\Models\NotificationModel();

        $trips = $NotificationModel->getAllNotificationsWithTrips();

        if (!$trips) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ سفری فعالی یافت نشد'], 404);
        }







        $tripsData = [];
        foreach ($trips as $trip) {
            $tripsData[] = [
            'toll' => $trip['toll'],
            'endAdd' => $trip['endAdd'],
            'weather' => $trip['weather'],
            'startAdd' => $trip['startAdd'],
            'distance' => $trip['distance'],
            'waitRate' => $trip['waitRate'],
            'endPoint' => $trip['endPoint'],
            'badRoadKM' => $trip['badRoadKM'],
            'finalFare' => $trip['finalFare'],
            'Waithours' => $trip['Waithours'],
            'startPoint' => $trip['startPoint'],
            'badRoadRate' => $trip['badRoadRate'],
            'travelTime' => $trip['travelTime'],
            'weatherRate' => $trip['weatherRate'],
            'roadCondition' => $trip['roadCondition'],
            'isFriday' => $trip['isFriday'],
            'passengerRate' => $trip['passengerRate'],
            'Packgae' => $trip['Packgae'],


            'extraPassenger' => $trip['extraPassenger'],
            'TimeMin' => $trip['TimeMin'],
            'fare' => $trip['fare'],
            'badRoad' => $trip['badRoad'],
            'isWait' => $trip['isWait'],


            'trip_date' => $trip['trip_date'],
            'trip_time' => $trip['trip_time'],
  


            'total_passenger' => $trip['total_passenger'],
            'end_address_desc' => $trip['end_address_desc'],
            'start_address_desc' => $trip['start_address_desc'],
            'status' => $trip['status'],

            ];
        }

        return $this->respond(['status' => 'success', 'trips' => $tripsData]);
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
