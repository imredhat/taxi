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
use CodeIgniter\RESTful\ResourceController;

class TripReport extends ResourceController
{
    protected $modelName = \App\Models\TripsModel::class;
    protected $format    = 'json';

    public function index()
    {

        $data['User']    = (new UserModel())->findAll();
        $data['Drivers']    = (new DriverModel())->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('Report/Trips/index',$data);
        echo view('parts/footer');
    }

}