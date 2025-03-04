<?php
namespace App\Controllers;

use App\Models\BankModel;
use App\Models\DriverModel;
use App\Models\FareModel;
use App\Models\NotificationModel;
use App\Models\PackagesModel;
use App\Models\TransactionModel;
use App\Models\TripsModel;
use App\Models\UserModel;
use App\Models\RequestModel;
use CodeIgniter\RESTful\ResourceController;

use GatewayWorker\Lib\Gateway;
use WebSocket\Client;

class Trips extends ResourceController
{
    protected $modelName = \App\Models\TripsModel::class;
    protected $format    = 'json';

    public function index()
    {

        $data['Trip']    = (new TripsModel())->getAllTripsWithDriverName();
        $data['Package'] = (new PackagesModel())->findAll();
        $Banks     = new BankModel();
        $data['bnks'] = $Banks ->where('active','1') -> findAll();

        $data['Title']   = 'استعلام ها';

        // echo json_encode ($data);die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('trip_list', $data);
        echo view('modal/PayingFare');
        echo view('modal/UpdateStatus');
        echo view('modal/ViewItem');
        echo view('modal/EditModal');
        echo view('modal/Transaction');
        echo view('modal/TrancactionAddModal');
        echo view('modal/Request');
        echo view('modal/Dwt');
        echo view('modal/toasts');
        echo view('parts/footer');
    }

    public function NewTrip()
    {

        $data['Packages'] = (new PackagesModel())->findAll();
        $data['options']  = (new FareModel())->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('AddService_neshan', $data);
        echo view('parts/footer');
    }

    public function getJSON()
    {
        $trips = $this->model->findAll();
        return $this->respond($trips);
    }

    // Get a single trip by ID
    public function Step2()
    {
        $uri = service('uri');
        $id  = $uri->getSegment(3);

        $trip = $this->model->find($id);
        if ($trip) {
            return $this->respond($trip);
        } else {
            return $this->failNotFound('Trip not found');
        }
    }

    // Create a new trip
    public function AddTrip()
    {
        // Get POST data
        $model = new TripsModel();

        $data = $this->request->getPost();

        $data['startPoint'] = implode(',', $this->request->getPost('startPoint'));
        $data['endPoint']   = implode(',', $this->request->getPost('endPoint'));

        $data['userCustomFare'] = preg_replace('/\D/', '', $this->request->getPost('userCustomFare'));
        $data['driverCustomFare'] = preg_replace('/\D/', '', $this->request->getPost('driverCustomFare'));
        if (! empty($this->request->getPost('company_name'))) {
            $data['company_factor'] = "Yes";
        }


        // print_r($data);die();

        /*******************************************
         * Check if the passenger is a guest
         ******************************************/


        /**************************** END Check ****************************************/

        if ($this->model->save($data)) {
            $id = $this->model->insertID();

            return $this->respond([
                'status'  => "OK",
                'message' => 'Trip created successfully',
                'ID'      => $id,
            ], 201); // 201 is the HTTP status code for "Created"
        } else {
            // If saving fails, return an error response
            return $this->fail('Failed to save the trip data');
        }
    }

    public function createUser($mobile, $name)
    {
        $UserModel = new UserModel();
        $User      = $UserModel->find($mobile);

        if (! $User) {

            $nameParts = explode(' ', $name);
            $firstName = $nameParts[0];
            $lastName  = isset($nameParts[1]) ? $nameParts[1] : '';

            $now         = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
            $persianDate = \IntlDateFormatter::create('fa_IR@calendar=persian', \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE, 'Asia/Tehran', \IntlDateFormatter::TRADITIONAL)->format($now);

            $UserModel->insert([
                'mobile'     => $mobile,
                'name'       => $firstName,
                'lname'      => $lastName,
                'type'       => 'حقیقی',
                'status'     => 'تایید شده',
                'date_start' => $persianDate,
            ]);

            return $UserModel->insertID();
        } else {
            return $User['id'];
        }

    }

    public function FindID()
    {
        $TEL = $this->request->getPost('Tel');

        // $ORGID = $ID - 1000;
        $User = new UserModel();
        if ($User = $User->where('mobile', $TEL)->first()) {

            return $this->respond([
                'status'  => "OK",
                'message' => 'Found',
                'User'    => $User,
            ], 201);
        } else {
            // If saving fails, return an error response
            return $this->fail('NoResult');
        }
    }

    public function GetTrip()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(3);

        $Trip = new TripsModel();
        if ($data['Trip'] = $Trip->find($ID)) {
            echo view("modal/TripDetail", $data);
        } else {
            return $this->fail('NotFound');
        }
    }

    public function Factor()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(3);

        $Trip = new TripsModel();
        if ($data['Trip'] = $Trip->find($ID)) {
            

            $tr                   = new TransactionModel();
            $data['transactions'] = $tr->where('tripID', $ID)->where('row_status', 'insert')->where('type', 'in')->withDeleted()->findAll();

            $BankModel    = new \App\Models\BankModel();
            $data['Bank'] = $BankModel->find($data['Trip']['bank']);

 
            if(isset($data['Trip']['driverID'])  && $data['Trip']['driverID']>0 and !empty($data['Trip']['driverID'])){
                $DriverModel = new DriverModel();
                $data['Driver'] = $DriverModel->find($data['Trip']['driverID']);
    
                $CarModel = new \App\Models\CarModel();
                $data['Car'] = $CarModel->getAllCarsWithLinkedData($data['Trip']['driverID']);
            }
            


 
            // echo json_encode($data);
            // die();

            // print_r($data);die();

            echo view('parts/print/header');
            echo view("modal/Factor", $data);
            echo view('parts/print/footer');
        } else {
            return $this->fail('NotFound');
        }
    }
    public function pishFactor()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(3);

        $Trip = new TripsModel();
        if ($data['Trip'] = $Trip->find($ID)) {
            

            $tr                   = new TransactionModel();
            $data['transactions'] = $tr->where('tripID', $ID)->where('row_status', 'insert')->where('type', 'in')->withDeleted()->findAll();

            $BankModel    = new \App\Models\BankModel();
            $data['Bank'] = $BankModel->find($data['Trip']['bank']);

 
            if(isset($data['Trip']['driverID'])  && $data['Trip']['driverID']>0 and !empty($data['Trip']['driverID'])){
                $DriverModel = new DriverModel();
                $data['Driver'] = $DriverModel->find($data['Trip']['driverID']);
    
                $CarModel = new \App\Models\CarModel();
                $data['Car'] = $CarModel->getAllCarsWithLinkedData($data['Trip']['driverID']);
            }
            


 
            // echo json_encode($data);
            // die();

            // print_r($data);die();

            echo view('parts/print/header');
            echo view("modal/pishFactor", $data);
            echo view('parts/print/footer');
        } else {
            return $this->fail('NotFound');
        }
    }

    public function Detail()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(2);

        $Request      = new TripsModel();
        $res          = $Request->getTripDetails($ID);
        $data['trip'] = $res;

        // echo "<pre>";
        // print_r($res);
        // die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('modal/trip_factor', $data);
        echo view('parts/footer');
    }

    public function CreateNotif()
    {
        $ID            = $this->request->getPost('tripID');

        // echo $ID;
        // die();
        $UserFare      = $this->request->getPost('UserFare');
        $DriverFare    = $this->request->getPost('DriverFare');
        $DriverPackage = $this->request->getPost('DriverPackage');

        $data = [
            'tripID'           => $ID,
            // 'userCustomFare'   => $UserFare,
            // 'driverCustomFare' => $DriverFare,
            // 'package'          => $DriverPackage,
        ];

        $Notif         = new NotificationModel();
        $existingNotif = $Notif->where('tripID', $ID)->first();

        if ($existingNotif) {
            $Notif->update($existingNotif['id'], $data);
        } else {
            $Notif->save($data);
        }

        // $now = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
        // $persianDate = \IntlDateFormatter::create('fa_IR@calendar=persian', \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE, 'Asia/Tehran', \IntlDateFormatter::TRADITIONAL)->format($now);
        // $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        // $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        // $date       = str_replace($persianNumbers, $englishNumbers, $persianDate);
        

        require_once APPPATH . 'Libraries/jdf.php';
        $currentDate = jdate('Ymd');
        $currentTime = jdate('H:i:s');
        $date = $currentDate . '-' . $currentTime;

            
            
        $tdata = [
            'status' => 'Notifed',
            'package' => $DriverPackage,
            'notified_time' => $date
        ];

        $Trip = new TripsModel();
        $Trip->update($ID, $tdata);


        return $this->respond([
            'status'  => "OK",
            'message' => 'Notification processed successfully',
        ], 201);
    }

    public function UpdateStatus()
    {
        $ID     = $this->request->getPost('tripID');
        $Status = $this->request->getPost('Status');

        $tdata['status'] = $Status;

        $Trip = new TripsModel();
        


        if($Status == 'Confirm'){

            $T = $Trip -> find($ID);

            $UserModel = new UserModel();
            $existingUser = $UserModel->where('mobile', $T['passenger_tel'])->first();

            if (!$existingUser) {
                $data['passenger_name'] = $this->request->getPost('passenger_name');
                $data['passenger_tel'] = $this->request->getPost('passenger_tel');
                $UserID = $this->createUser($data['passenger_tel'], $data['passenger_name']);

                $tdata['passenger_id']=$UserID;
            } else {
                $tdata['passenger_id'] = $existingUser['id'];
            }

        }

        if($Status == 'Notifed'){

            $now = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
            $persianDate = \IntlDateFormatter::create('fa_IR@calendar=persian', \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE, 'Asia/Tehran', \IntlDateFormatter::TRADITIONAL)->format($now);
            $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $date       = str_replace($persianNumbers, $englishNumbers, $persianDate);

            $tdata['notified_time'] = $date.'-'.$now->format('H:i:s');
        }

        // print_r($tdata);die();


        $Trip->update($ID, $tdata);


        // if($Status == 'Notifed'){
        //     Gateway::$registerAddress = '0.0.0.0:6321';

        //     $DriverModel = new DriverModel();
        //     $drivers = $DriverModel->where('ws_id IS NOT NULL and ws_id > 0')->findAll();

            


        //     foreach ($drivers as $driver) {

        //         $CarModel = new \App\Models\CarModel();
        //         $activeCar = $CarModel->where('driver_id', $driver['did'])->where('active', '1')->first();
        //         $activeCarID = $activeCar['cid'];

        //         $requestModel = new RequestModel();
        //         $newRequests = $requestModel->getNewRequest($driver['did'], $activeCarID);

        //         // print_r($newRequests);die();

        //         // echo $driver['ws_id'];
        //         // die();

        //         $message = [
        //             'type' => 'Push_Trip',
        //             'trips' => $newRequests,
        //             'status' => 'success',
        //         ];


        //         Gateway::sendToClient($driver['ws_id'], json_encode($message));
        //     }

        // }

        if ($Trip) {
            return $this->respond([
                'status'  => "OK",
                'message' => 'Status changed successfully',
                'class'   => $this->getServiceDIV($Status),
            ], 201);
        } else {
            return $this->fail('Failed to update the status');
        }
    }

    public function Dwt()
    {
        $ID = $this->request->getPost('tripID');

        $Trip = new TripsModel();
        $Trip->delete($ID);

        if ($Trip) {
            return $this->respond([
                'status'  => "OK",
                'message' => 'trip deleted successfully',
            ], 201);
        } else {
            return $this->fail('Failed to delete the trip');
        }
    }

    public function getServiceDIV($status)
    {
        switch ($status) {
            case 'Called':
                return 'bg-primary ';
            case 'Reserve':
                return 'bg-secondary ';
            case 'Confirm':
                return 'bg-success ';
            case 'Notifed':
                return 'bg-warning ';
            case 'Cancled':
                return 'bg-danger ';
            case 'Requested':
                return 'bg-info ';
            case 'Service':
                return 'bg-light ';
            case 'Done':
                return 'bg-dark ';
        }
    }

    public function EditTrip()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(2);

        $Trip         = new TripsModel();
        $data['Trip'] = $Trip->find($ID);

        $data['Packages'] = (new PackagesModel())->findAll();
        $data['options']  = (new FareModel())->findAll();
        $data['driver']   = (new DriverModel())->findAll();
        $data['banks']    = (new BankModel())->findAll();

        // echo "<pre>";
        // print_r($data['driver']);
        // die();

        echo view('modal/EditTrip', $data);
    }

    public function UpdateTrip()
    {
        $ID = $this->request->getPost('id');

        $data = [
            'startAdd'         => $this->request->getPost('startAdd'),
            'endAdd'           => $this->request->getPost('endAdd'),
            'trip_date'        => $this->request->getPost('trip_date'),
            'trip_time'        => $this->request->getPost('trip_time'),
            'weather'          => $this->request->getPost('weather'),
            'userCustomFare'   => $this->request->getPost('passengerFare'),
            'driverCustomFare' => $this->request->getPost('driverFare'),
            'trip_type'        => $this->request->getPost('trip_type'),
            'driverID'         => $this->request->getPost('driverID'),
            'carID'            => $this->request->getPost('carID'),
            'passenger_id'     => $this->request->getPost('passenger_id'),
            'isGuest'          => $this->request->getPost('isGuest'),
            'passenger_name'   => $this->request->getPost('passenger_name'),
            'passenger_tel'    => $this->request->getPost('passenger_tel'),
            'guest_name'       => $this->request->getPost('guest_name'),
            'guest_tel'        => $this->request->getPost('guest_tel'),
            'total_passenger'  => $this->request->getPost('total_passenger'),
            'wait_hours'       => $this->request->getPost('wait_hours'),
            'status'           => $this->request->getPost('status'),
            'package'          => $this->request->getPost('package_edit'),
            'dsc'              => $this->request->getPost('dsc'),
            'note'              => $this->request->getPost('note'),
            'bank'             => $this->request->getPost('bank'),
            'call_date'             => $this->request->getPost('call_date'),
            'call_time'             => $this->request->getPost('call_time'),
            'company_name'             => $this->request->getPost('company_name'),
            'payment_status'             => $this->request->getPost('payment_status'),            
        ];



    // print_r($data);die();
        

        $data['userCustomFare']   = preg_replace('/\D/', '', $data['userCustomFare']);
        $data['driverCustomFare'] = preg_replace('/\D/', '', $data['driverCustomFare']);
        // $data['finalFare']        = preg_replace('/\D/', '', $data['finalFare']);

        /*******************************************
         * Check if the passenger is a guest
         ******************************************/


        if($data['status'] == 'Confirm'){


            $UserModel = new UserModel();
            $existingUser = $UserModel->where('mobile', $data['passenger_tel'])->first();

            if (!$existingUser) {
                $data['passenger_name'] = $this->request->getPost('passenger_name');
                $data['passenger_tel'] = $this->request->getPost('passenger_tel');

                $UserID = $this->createUser($data['passenger_tel'], $data['passenger_name']);

                $data['passenger_id']=$UserID;
            }else {
                $data['passenger_id'] = $existingUser['id'];
            }


        }


        if ($data['status'] == 'Notifed') {
            $now = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
            $persianDate = \IntlDateFormatter::create('fa_IR@calendar=persian', \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE, 'Asia/Tehran', \IntlDateFormatter::TRADITIONAL)->format($now);
            $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $date       = str_replace($persianNumbers, $englishNumbers, $persianDate);

            
            $data['notified_time'] = $date.'-'.$now->format('H:i:s');
        }


        /**************************** END Check *************************************** */

        if (isset($data['driverID']) && $data['driverID'] > 0) {
            $RequestModel = new RequestModel();
            $existingRequest = $RequestModel->where('tripID', $ID)->where('driverID', $data['driverID'])->first();

            if (!$existingRequest) {
                $requestData = [
                    'tripID'     => $ID,
                    'driverID'   => $data['driverID'],
                    'carID'      => $data['carID'],
                    'isAccepted' => "YES", // Assuming default value is 0
                    'notified'   => 0, // Assuming default value is 0
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $RequestModel->insert($requestData);
            }
        }



        /**************************** END Check *************************************** */

        $Trip = new TripsModel();
        if ($Trip->update($ID, $data)) {

            return $this->respond([
                'status'  => "OK",
                'message' => 'Trip updated successfully',
                'class'   => $this->getServiceDIV($data['status']),
            ], 200);
        } else {
            return $this->fail('Failed to update the trip');
        }
    }

    // Update an existing trip by ID
    public function update($id = null)
    {
        $data       = $this->request->getRawInput(); // Get raw data (PUT or PATCH)
        $data['id'] = $id;

        if ($this->model->save($data)) {
            return $this->respond($data);
        } else {
            return $this->failValidationErrors($this->model->errors());
        }
    }

    // Delete a trip by ID (soft delete)
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failNotFound('Trip not found');
        }
    }
}
