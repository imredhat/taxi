<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Trips extends ResourceController
{

    protected $modelName = \App\Models\TripModel::class;
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
        $model = new TripModel();
        $data = [
            'start_loc'         => implode(',', $this->request->getPost('startPoint')),
            'end_loc'           => implode(',', $this->request->getPost('endPoint')),
            'start_loc_text'    => $this->request->getPost('startAdd'),
            'end_loc_text'      => $this->request->getPost('endAdd'),
            'distance'          => $this->request->getPost('distance'),
            'travelTime'        => $this->request->getPost('travelTime'),
            'roadCondition'     => $this->request->getPost('roadCondition'),
            'weather'           => $this->request->getPost('weather'),
            'carType'           => $this->request->getPost('carType'),
            'isHoliday'         => $this->request->getPost('isHoliday') === 'true' ? 1 : 0,
            'fare'              => $this->request->getPost('fare'),

            'passenger_id'      => $this->request->getPost('fare'),
            'isGuest'           => $this->request->getPost('isGuest'),
            'trip_date'         => $this->request->getPost('trip_date'),
            'trip_time'         => $this->request->getPost('trip_time'),
            'company_name'      => $this->request->getPost('company_name'),
            'passenger_name'    => $this->request->getPost('passenger_name'),
            'passenger_tel'     => $this->request->getPost('passenger_tel'),
            'total_passenger'   => $this->request->getPost('total_passenger'),
            'end_address_desc'  => $this->request->getPost('end_address_desc'),
            'start_address_desc'=> $this->request->getPost('start_address_desc'),
        ];

        if(!empty($this->request->getPost('company_name'))){
            $data['company_factor'] = "Yes";
        }

        if(($this->request->getPost('isGuest')) == "0"){
            $ID = $this->request->getPost('passenger_id');

            $data['guest_name'] = $this->request->getPost('passenger_name');
            $data['guest_tel'] = $this->request->getPost('passenger_tel');

            $User = new UserModel();
            $User = $User->find($ID);

            $data['passenger_name'] = $User['name']." ".$User['lname'] ;
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
