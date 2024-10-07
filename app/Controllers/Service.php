<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\CarModel;
use App\Models\DriverModel;
use App\Models\ServiceModel;
use App\Models\UserModel;

class Service extends BaseController
{

    function __construct()
    {
        $session = service('session');

        // echo($session -> user_id);
        if (!$session->has('user_id')) {
            return redirect()->to('auth');
        }
    }

    public function index()
    {

        $services = new ServiceModel();
        $data['Service'] = $services->getAllService();

        // echo "<pre>";
        // print_r($data);
        // die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('service_list', $data);
        echo view('parts/footer');
    }

    public function AllServices()
    {

        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('service');
        $crud->setSubject('سرویس', 'سرویس‌ها');
        $crud->setRead();
        $crud->unsetAdd();

        $crud->columns(['id', 'passenger_id', 'driver_id', 'service_id', 'trip_date', 'start_location', 'price',  'service_type', 'service_status', 'isPaid', 'isTax']);
        $crud->fields(['passenger_id', 'passenger_type', 'driver_id', 'car_id', 'service_id', 'category', 'call_date', 'trip_date', 'start_location', 'end_location', 'price', 'factor_status', 'service_type', 'service_status', 'isPaid', 'isTax', 'extraPassenger', 'extra']);
        $crud->readFields(['passenger_id', 'passenger_type', 'driver_id', 'car_id', 'service_id', 'category', 'call_date', 'trip_date', 'start_location', 'end_location', 'price', 'factor_status', 'service_type', 'service_status', 'isPaid', 'isTax', 'extraPassenger', 'extra']);

        $crud->displayAs('id', "شناسه سرویس");
        $crud->displayAs('passenger_id', " مسافر");
        $crud->displayAs('passenger_type', "نوع مسافر");
        $crud->displayAs('driver_id', "شناسه راننده");
        $crud->displayAs('car_id', "پلاک خودرو");
        $crud->displayAs('service_id', "شناسه سرویس");
        $crud->displayAs('category', "دسته‌بندی");
        $crud->displayAs('call_date', "تاریخ تماس");
        $crud->displayAs('trip_date', "تاریخ سفر");
        $crud->displayAs('start_location', "مکان شروع");
        $crud->displayAs('end_location', "مکان پایان");
        $crud->displayAs('price', "قیمت");
        $crud->displayAs('factor_status', "وضعیت فاکتور");
        $crud->displayAs('service_type', "نوع سرویس");
        $crud->displayAs('service_status', "وضعیت ");
        $crud->displayAs('isPaid', "پرداخت شده");
        $crud->displayAs('isTax', "مالیات");
        $crud->displayAs('extraPassenger', "مسافر اضافی");
        $crud->displayAs('extra', "نکات اضافی");

        $crud->fieldType('passenger_type', 'dropdown', ['P' => 'حقیقی', 'C' => 'شرکتی']);
        $crud->fieldType('category', 'dropdown', ['exclusive' => 'دربستی', 'ticket' => 'بلیط']);
        $crud->fieldType('factor_status', 'dropdown', ['Yes' => 'بله', 'No' => 'خیر']);
        $crud->fieldType('service_type', 'dropdown', ['OneWay' => 'یک طرفه', 'Sweep' => 'رفت و برگشت', 'Full' => 'در اختیار']);
        $crud->fieldType('service_status', 'dropdown', ['Call' => 'استعلام', 'Reserve' => 'رزرو', 'Confirm' => ' تایید شده', 'Cancled' => 'لغو شده']);
        $crud->fieldType('isPaid', 'dropdown', ['Yes' => 'بله', 'No' => 'خیر']);
        $crud->fieldType('isTax', 'dropdown', ['Yes' => 'بله', 'No' => 'خیر']);

        $crud->setRelation('driver_id', 'driver', '{name} {lname}');
        $crud->setRelation('passenger_id', 'user', '{name} {lname}');
        $crud->setRelation('car_id', 'cars', '{pelak} {harf} {pelak_last}');




        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }


    public function AddService()
    {

        $data['Users']      = (new UserModel())->findAll();
        $data['Drivers']    = (new DriverModel())->withDeleted()->findAll();

        // print_r($data['Drivers']);
        // die();


        echo view('parts/header');
        echo view('parts/side');
        echo view('AddService_mapbox', $data);
        echo view('parts/footer');
    }

    public function GetDriverCarList()
    {
        $id = $this->request->getPost('driver_id');

        $Cars = ((new CarModel())->GetDriverCars($id));

        echo json_encode($Cars);

        // return (new CarModel())->GetDriverCars($id);
    }

    public function createOrder()
    {
        $orderModel = new ServiceModel();

        // Retrieve the request data (array format)
        $data = $this->request->getPost();

        if($data['isReturnTrip']){
            $serviceType = "Sweep";
        }else{
            $serviceType = "OneWay";
        }

        $serviceNumber = $this -> generateRandomNumber();
        
        
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


    function generateRandomNumber() {
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
