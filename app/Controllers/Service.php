<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\CarModel;
use App\Models\DriverModel;
use App\Models\ServiceModel;
use App\Models\UserModel;
use App\Models\FareModel;
use App\Models\PackagesModel;
use App\Models\RequestModel;
use App\Models\TripsModel;

class Service extends BaseController
{

    public function index()
    {

        $Request = new RequestModel();
        $res = $Request -> getAllRequestWithDetail();
        $data['Request'] =$res;

        // echo "<pre>";
        // print_r($res);
        // die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('service_list', $data);
        echo view('parts/footer');
    }


    public function AddService()
    {

        $data['Packages']    = (new PackagesModel())->findAll();
        $data['Users']      = (new UserModel())->findAll();
        $data['Drivers']    = (new DriverModel())->withDeleted()->findAll();
        $data['options']    = (new FareModel())->findAll();


        echo view('parts/header');
        echo view('parts/side');
        echo view('AddService_neshan', $data);
        echo view('parts/footer');
    }

    public function GetDriverCarList()
    {
        $id = $this->request->getPost('driver_id');

        $Cars = (new CarModel())->GetDriverCars($id);

        echo json_encode($Cars);

        // return (new CarModel())->GetDriverCars($id);
    }

    public function createOrder()
    {
        $orderModel = new ServiceModel();

        // Retrieve the request data (array format)
        $data = $this->request->getPost();

        if ($data['isReturnTrip']) {
            $serviceType = "Sweep";
        } else {
            $serviceType = "OneWay";
        }

        
        $serviceNumber = $this->generateRandomNumber();


        // Prepare the data for insertion
        $orderData = [
            'passenger_id'     => $data['passenger'],
            'passenger_type'   => 'P', // Assuming 'P' for regular passenger, modify as per logic
            'extraPassenger'   => 0, // Modify according to your logic
            'driver_id'        => $data['driver'],
            'car_id'           => $data['car'],
            'service_type'     => $serviceType, // Assuming one-way for now
            'service_status'   => 'Confirm', // Assuming it's in call status
            'category'         => 'exclusive', // Modify as per your logic
            'call_date'        => $data['callDate'],
            'trip_date'        => $data['tripDate'],
            'start_location'   => implode(',', $data['startPoint']), // Convert array to string, comma-separated
            'end_location'     => implode(',', $data['endPoint']),   // Convert array to string, comma-separated
            'price'            => $data['fareDetails']['fare'],
            'factor_status'    => $data['isFactor'] ? 'Yes' : 'No',
            'isPaid'           => $data['isPaid'] ? 'Yes' : 'No',
            'isTax'            => $data['isTax'] ? 'Yes' : 'No',
            'extra'            => $data['desc'], // Extra data like description
            'service_id'       => $serviceNumber
        ];

        // Insert the data into the database
        $orderModel->insert($orderData);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Order created successfully!']);
    }


    function generateRandomNumber()
    {
        // تولید چهار رقم رندوم
        $randomFourDigits = rand(1000, 9999);

        // ترکیب دو رقم اول 10 با چهار رقم رندوم
        $randomSixDigits = '10' . $randomFourDigits;

        return $randomSixDigits;
    }

    // استفاده از تابع



    public function getOrder($id)
    {
        $orderModel = new ServiceModel();
        $order = $orderModel->find($id);

        if ($order) {
            return $this->response->setJSON($order);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Order not found']);
        }
    }
}
