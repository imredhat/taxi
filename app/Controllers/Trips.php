<?php

namespace App\Controllers;

use App\Models\FareModel;
use App\Models\UserModel;
use App\Models\TripsModel;
use App\Models\PackagesModel;
use App\Models\NotificationModel;
use CodeIgniter\RESTful\ResourceController;

class Trips extends ResourceController
{

    protected $modelName = \App\Models\TripsModel::class;
    protected $format    = 'json';



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

        $data['Trip'] = (new TripsModel())->findAll();
        $data['Package'] = (new PackagesModel())->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('service_list', $data);
        echo view('modal/PayingFare');
        echo view('modal/UpdateStatus');
        echo view('modal/ViewItem');
        echo view('modal/Request');
        echo view('modal/Dwt');
        echo view('modal/toasts');

        echo view('parts/footer');
    }

    public function NewTrip()
    {

        $data['Packages']    = (new PackagesModel())->findAll();
        $data['options']    = (new FareModel())->findAll();


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
        $id = $uri->getSegment(3);


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
        $data['endPoint'] = implode(',', $this->request->getPost('endPoint'));




        if (!empty($this->request->getPost('company_name'))) {
            $data['company_factor'] = "Yes";
        }

        if (($this->request->getPost('isGuest')) == "0") {


            if (isset(($ID)) && $ID > 0) {
                $User = new UserModel();
                $User = $User->find($ID);

                $data['passenger_name'] = $User['name'] . " " . $User['lname'];
                $data['passenger_tel'] = $User['mobile'];
            } else {
                $data['guest_name'] = $this->request->getPost('passenger_name');
                $data['guest_tel'] = $this->request->getPost('passenger_tel');

                $data['passenger_name'] = "";
                $data['passenger_tel'] = "";
            }
        } else {
            $ID = $this->request->getPost('passenger_id');
            $User = new UserModel();
            $User = $User->find($ID);

            $data['passenger_name'] = $User['name'] . " " . $User['lname'];
            $data['passenger_tel'] = $User['mobile'];
        }


        if ($this->model->save($data)) {
            $id = $this->model->insertID();

            return $this->respond([
                'status' => "OK",
                'message' => 'Trip created successfully',
                'ID' => $id
            ], 201);  // 201 is the HTTP status code for "Created"
        } else {
            // If saving fails, return an error response
            return $this->fail('Failed to save the trip data');
        }
    }



    public function FindID()
    {
        $ID = $this->request->getPost('ID');

        $User = new UserModel();
        if ($User = $User->find($ID)) {

            return $this->respond([
                'status' => "OK",
                'message' => 'Trip created successfully',
                'User' => $User
            ], 201);
        } else {
            // If saving fails, return an error response
            return $this->fail('Failed to save the trip data');
        }
    }



    public function GetTrip()
    {
        $uri = service('uri');
        $ID = $uri->getSegment(3);

        $Trip = new TripsModel();
        if ($data['Trip'] = $Trip->find($ID)) {
            echo view("modal/TripDetail", $data);
        } else {
            return $this->fail('NotFound');
        }
    }







    public function CreateNotif()
    {
        $ID = $this->request->getPost('tripID');
        $UserFare = $this->request->getPost('UserFare');
        $DriverFare = $this->request->getPost('DriverFare');

        $data = [
            'tripID' => $ID,
            'userCustomFare' => $UserFare,
            'diiverCustomFare' => $DriverFare,
        ];

        $Notif = new NotificationModel();
        $Notif = $Notif->save($data);
        if ($Notif) {

            $tdata = [
                'status' => 'Notifed'
            ];

            $Trip = new TripsModel();
            $Trip->update($ID, $tdata);

            return $this->respond([
                'status' => "OK",
                'message' => 'Notification created successfully',
            ], 201);
        } else {
            return $this->fail('Failed to save the notification data');
        }
    }





    public function UpdateStatus()
    {
        $ID = $this->request->getPost('tripID');
        $Status = $this->request->getPost('Status');


        $tdata = [
            'status' => $Status
        ];

        $Trip = new TripsModel();
        $Trip->update($ID, $tdata);

        if ($Trip) {
            return $this->respond([
                'status' => "OK",
                'message' => 'Status changed successfully',
                'class' => $this -> getServiceDIV($Status)
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
                'status' => "OK",
                'message' => 'trip deleted successfully'
            ], 201);
        } else {
            return $this->fail('Failed to delete the trip');
        }
    }




    
function getServiceDIV($status)
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
        case 'Done':
            return 'bg-dark ';
    }
}





















    // Update an existing trip by ID
    public function update($id = null)
    {
        $data = $this->request->getRawInput(); // Get raw data (PUT or PATCH)
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
