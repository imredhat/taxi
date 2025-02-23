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

        $cars = $CarModel -> getAllCarsWithLinkedData($driverId);

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
                'type_name' => $car['type_name'],
                'color' => $car['color'],
            ];
        }

        // echo json_encode($carsData);die();

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
            $trips = $TripsModel->getMyRequest($driverID, $from_date, $to_date,"Done");
        } else {
            $trips = $TripsModel->getMyRequest($driverID,null,null,"Done");
        }


        $total['totalTrips'] = count($trips);
        $total['totalFare'] = array_sum(array_column($trips, 'driverCustomFare'));

     

        if (!$trips || empty($trips)) {
            return $this->respond(['status' => 'error', 'message' => 'هیچ سفری یافت نشد'], 404);
        }

        return $this->respond(['status' => 'success', 'trips' => $trips , 'total' => $total]);
    }



    public function onGoingTrip()
    {
        $hash = $this->request->getPost('hash');

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
        $trips = $TripsModel->getMyRequest($driverID, '','',"Confirm");

      

        if (!$trips || empty($trips)) {
            return $this->respond(['status' => 'success', 'message' => 'هیچ سفری یافت نشد', 'trips' => $trips, 404]);
        }

        return $this->respond(['status' => 'success', 'trips' => $trips]);
    }


    public function Brands()
    {
        $BrandModel = new BrandModel();
        $brands = $BrandModel->orderBy('brand' , 'DESC')->withDeleted()->findAll();

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
        $AllTypes = $Types->orderBy('bid' , 'DESC')->withDeleted()->findAll();

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


    public function SetActiveCar(){
        $hash = $this->request->getPost('hash');
        $carID = $this->request->getPost('carID');

        if (empty($hash) || empty($carID)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده یا خودرو نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        $CarModel = new CarModel();
        $car = $CarModel->where('cid', $carID)->first();

        if (!$car) {
            return $this->respond(['status' => 'error', 'message' => 'خودرو یافت نشد'], 404);
        }
        

        $tdata = [
            'active' => 1
        ];
        $CarModel->where('driver_id', $driver['did'])->set(['active' => 0])->update();
        $CarModel->update($carID, $tdata);

        // $CarModel->update($carID, ['active' => 1]);

        return $this->respond(['status' => 'success', 'message' => 'خودرو با موفقیت فعال شد']);
    }

    public function addCar()
    {
        $hash = $this->request->getPost('hash');
        // $DID = $this->request->getPost('driver_id');

    // print_r($_POST);die();

        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        $brand = $this->request->getPost('brand');



        $DID = $driver['did'];

        $carData = [
            'driver_id'                 => $DID,
            'owner'                     => $this->request->getPost('owner'),
            'brand'                     => $brand,
            'fuel'                      => $this->request->getPost('fuel'),
            'iran'                      => $this->request->getPost('iran'),
            'pelak'                     => $this->request->getPost('pelak'),
            'pelak_last'                => $this->request->getPost('pelak_last'),
            'harf'                      => $this->request->getPost('harf'),
            'pic_back'                  => $this->upload_file('pic_back', "drivers", $DID),
            'pic_front'                 => $this->upload_file('pic_front', "drivers", $DID),
            'pic_in_back'               => $this->upload_file('pic_in_back', "drivers", $DID),
            'pic_in_front'              => $this->upload_file('pic_in_front', "drivers", $DID),
            'scan_car_card'             => $this->upload_file('scan_car_card', "drivers", $DID),
            'scan_car_card_back'        => $this->upload_file('scan_car_card_back', "drivers", $DID),
            'scan_insurance'            => $this->upload_file('scan_insurance', "drivers", $DID),
            'scan_insurance_addendum'   => $this->upload_file('scan_insurance_addendum', "drivers", $DID),
            'type'                      => $this->request->getPost('type'),
            'type_class'                => $this->request->getPost('type_class'),
            'year'                      => $this->request->getPost('year'),
            'vin'                       => $this->request->getPost('vin'),
            'color'                     => $this->request->getPost('color'),
            'insurance_expiry_date'     => $this->request->getPost('insurance_expiry_date'),
            'active'                    => 0,
        ];

        $Car = new CarModel();
        if($Car->insert($carData)){
            return $this->respond(['status' => 'success', 'message' => 'خودرو با موفقیت ثبت شد']);
        }else{
            return $this->respond(['status' => 'fail', 'message' => 'خطا در ثبت اطلاعات']);
        }

    }


    private function upload_file($field_name, $type, $DID)
    {
        $file = $this->request->getFile($field_name);
        if (! empty($file)) {
            $config = [
                'uploadPath'   => './uploads/' . $type . "/" . $DID,
                'allowedTypes' => 'jpg|jpeg|png',
                'maxSize'      => 1024,
            ];
            if ($file->isValid()) {
                if ( $file->move($config['uploadPath'])) {

                    $image = \Config\Services::image()
                        ->withFile($config['uploadPath'].'/'.$file->getName())
                        ->resize(800, 600, true, 'auto') // تغییر اندازه به 800x600 با حفظ نسبت
                        ->save($config['uploadPath'].'/'.$file->getName());

                    return $file->getName();


                }else{
                    $error = ['error' => 'Failed to upload file'];
                    return $error;
                }

                
            }
        }
    }
}
