<?php

namespace App\Controllers\API;

use App\Models\DriverModel;
use App\Models\RequestModel;
use App\Models\TripsModel;
use CodeIgniter\RESTful\ResourceController;

class Request extends ResourceController
{

    protected $modelName = \App\Models\RequestModel::class;
    protected $format = 'json';


    public function Send()
    {

        $hash = $this->request->getPost('hash');
        $carID = $this->request->getPost('carID');       
        $tripID = $this->request->getPost('tripID');
        $notifID = $this->request->getPost('notifID');


        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //+++++++++++++++++++++++++ Get Driver info ++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();
        $driverID = $driver['did'];

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }
    
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $Request = new RequestModel();
        $existingRequest = $Request->where('tripID', $tripID)
                                   ->where('driverID', $driverID)
                                   ->where('carID', $carID)
                                   ->first();

        if ($existingRequest) {
            return $this->respond(['status' => 'exist', 'message' => 'درخواست قبلاً ثبت شده است'], 200);
        }

        $data = [
            'tripID' => $tripID,
            'driverID' => $driverID,
            'carID' => $carID,
            'isAccepted' => "W8",
            'notifID' => $notifID,
            'created_at' => gmdate('Y-m-d H:i:s', time() + 12600)
        ];

        $Rq = new RequestModel();
        $Rq = $Rq->save($data);

        if ($Rq) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => 'request created',
            ]);
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'fail',
                'message' => 'failed to create request',
            ]);
        }
    }

    public function MyRequests()
    {
        $hash = $this->request->getPost('hash');
        $carID = $this->request->getPost('carID');

        if (empty($hash)) {
            return $this->respond(['status' => 'error', 'message' => 'راننده نامعتبر است'], 400);
        }

        $Driver = new DriverModel();
        $driver = $Driver->where('hash', $hash)->first();

        if (!$driver) {
            return $this->respond(['status' => 'error', 'message' => ' راننده نامعتبر است'], 401);
        }

        $driverID = $driver['did'];



        $Request = new RequestModel();
        $requests = $Request->getNewRequest( $driverID , $carID);

        if (!$requests) {
            return $this->respond(['status' => 'success', 'message' => 'هیچ سفری فعالی یافت نشد','data' => []], 200);
        }

        return $this->respond(['status' => 'success', 'data' => $requests], 200);
    } 
}
