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
