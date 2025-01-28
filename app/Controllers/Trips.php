<?php
namespace App\Controllers;

use App\Models\DriverModel;
use App\Models\FareModel;
use App\Models\NotificationModel;
use App\Models\PackagesModel;
use App\Models\TransactionModel;
use App\Models\TripsModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Trips extends ResourceController
{
    protected $modelName = \App\Models\TripsModel::class;
    protected $format    = 'json';

    public function index()
    {

        $data['Trip']    = (new TripsModel())->findAll();
        $data['Package'] = (new PackagesModel())->findAll();
        $data['Title'] = 'استعلام ها';

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

        if (! empty($this->request->getPost('company_name'))) {
            $data['company_factor'] = "Yes";
        }

        if (($this->request->getPost('isGuest')) == "1") {

            $ID = $this->request->getPost('passenger_id');

            if (isset(($ID)) && $ID > 0) {
                $User = new UserModel();
                $User = $User->find($ID);

                $data['passenger_name'] = $User['name'] . " " . $User['lname'];
                $data['passenger_tel']  = $User['mobile'];
            } else {
                $data['guest_name'] = $this->request->getPost('passenger_name');
                $data['guest_tel']  = $this->request->getPost('passenger_tel');

                $data['passenger_name'] = "";
                $data['passenger_tel']  = "";
            }
        } else {
            $ID   = $this->request->getPost('passenger_id');
            $User = new UserModel();
            $User = $User->find($ID);

            $data['passenger_name'] = $User['name'] . " " . $User['lname'];
            $data['passenger_tel']  = $User['mobile'];
        }

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

    public function FindID()
    {
        $ID = $this->request->getPost('ID');

        $ORGID = $ID - 1000;
        $User  = new UserModel();
        if ($User = $User->find($ORGID)) {

            return $this->respond([
                'status'  => "OK",
                'message' => 'Trip created successfully',
                'User'    => $User,
            ], 201);
        } else {
            // If saving fails, return an error response
            return $this->fail('Failed to save the trip data');
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
            $data['transactions'] = $tr->where('tripID', $ID)->where('row_status', 'insert')->where('type', 'in') -> withDeleted()->findAll();
            

       

            echo view('parts/print/header');
            echo view("modal/Factor", $data);
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
        $UserFare      = $this->request->getPost('UserFare');
        $DriverFare    = $this->request->getPost('DriverFare');
        $DriverPackage = $this->request->getPost('DriverPackage');

        $data = [
            'tripID'           => $ID,
            'userCustomFare'   => $UserFare,
            'driverCustomFare' => $DriverFare,
            'package'          => $DriverPackage,
        ];

        $Notif         = new NotificationModel();
        $existingNotif = $Notif->where('tripID', $ID)->first();

        if ($existingNotif) {
            $Notif->update($existingNotif['id'], $data);
        } else {
            $Notif->save($data);
        }

        $tdata = [
            'status' => 'Notifed',
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

        $tdata = [
            'status' => $Status,
        ];

        $Trip = new TripsModel();
        $Trip->update($ID, $tdata);

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

        // echo "<pre>";
        // print_r($data['driver']);
        // die();

        echo view('modal/EditTrip', $data);
    }

    public function UpdateTrip()
    {
        $ID   = $this->request->getPost('id');
        
        $data = [
            'startAdd'        => $this->request->getPost('startAdd'),
            'endAdd'          => $this->request->getPost('endAdd'),
            'trip_date'       => $this->request->getPost('trip_date'),
            'trip_time'       => $this->request->getPost('trip_time'),
            'weather'         => $this->request->getPost('weather'),
            'travelTime'      => $this->request->getPost('travelTime'),
            'distance'        => $this->request->getPost('distance'),
            'finalFare'       => $this->request->getPost('finalFare'),
            'userCustomFare'   => $this->request->getPost('passengerFare'),
            'driverCustomFare'      => $this->request->getPost('driverFare'),
            'trip_type'       => $this->request->getPost('trip_type'),
            'driverID'        => $this->request->getPost('driverID'),
            'carID'           => $this->request->getPost('carID'),
            'passenger_id'    => $this->request->getPost('passenger_id'),
            'isGuest'         => $this->request->getPost('isGuest'),
            'passenger_name'  => $this->request->getPost('passenger_name'),
            'passenger_tel'   => $this->request->getPost('passenger_tel'),
            'total_passenger' => $this->request->getPost('total_passenger'),
            'wait_hours'      => $this->request->getPost('wait_hours'),
            'status'          => $this->request->getPost('status'),
            'package'         => $this->request->getPost('package'),
        ];

        $data['userCustomFare'] = preg_replace('/\D/', '', $data['userCustomFare']);
        $data['driverCustomFare']    = preg_replace('/\D/', '', $data['driverCustomFare']);
        $data['finalFare']     = preg_replace('/\D/', '', $data['finalFare']);


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
