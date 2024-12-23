<?php

namespace App\Controllers;

use App\Models\DriverModel;
use App\Models\RequestModel;
use App\Models\TripsModel;
use CodeIgniter\RESTful\ResourceController;

class Request extends ResourceController
{

    protected $modelName = \App\Models\RequestModel::class;
    protected $format = 'json';

    public function index()
    {
        $data['Request'] = (new RequestModel())->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('request_list', $data);
        echo view('parts/footer');
    }

    public function imReady()
    {
        $tripID = $this->request->getPost('tripID');
        $notifID = $this->request->getPost('notifID');
        $driverID = $this->request->getPost('driverID');

        $data = [
            'tripID' => $tripID,
            'notifID' => $notifID,
            'driverID' => $driverID,
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

    public function getTripDrivers()
    {
        $tripID = $this->request->getPost('tripID');

        $Dr = new DriverModel();
        $Rq = new RequestModel();
        $Rq = $Rq->where("tripID", $tripID)->findAll();

        if ($Rq) {
            foreach ($Rq as $I => $R) {
                $driverID = $R['driverID'];
                $carID = $R['carID'];
                if ($RZ = $Dr->getDriverCarInfo($driverID, $carID)) {
                    foreach ($RZ as $Z => $V) {
                        $Rq[$I][$Z] = $V;
                    }
                }
            }
        }

        $data['request'] = $Rq;

        return view('modal/Request_Drivers', $data);
    }

    public function ConfirmReq()
    {
        $reqID = $this->request->getPost('RqID');
        $tripID = $this->request->getPost('tripID');
        $notifID = $this->request->getPost('notifID');
        $isAccepet = $this->request->getPost('isAccepet');

        $data = ["isAccepted" => $isAccepet];

        $Rq = new RequestModel();
        $Rq->update($reqID, $data);

        if ($Rq) {

            // $model = new TripsModel();
            // $isAccepted = $model->isAcceptedExists($tripID, $notifID);

            if ($isAccepet == "YES") {
                $data = ["status" => "Confirm"];

                $Rq = new TripsModel();
                $Rq->update($reqID, $data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'final' => true,
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'success',
                    'final' => false,
                ]);
            }
        }
    }
}
