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


    public function Search(){
        $user = $this->request->getGet('user');
        $driver = $this->request->getGet('driver');
        $loc_start = $this->request->getGet('loc_start');
        $loc_end = $this->request->getGet('loc_end');
        $contact_start_date = $this->request->getGet('contact_start_date');
        $contact_end_date = $this->request->getGet('contact_end_date');
        $trip_start_date = $this->request->getGet('trip_start_date');
        $trip_end_date = $this->request->getGet('trip_end_date');
        $guest_name = $this->request->getGet('guest_name');
        $guest_tel = $this->request->getGet('guest_tel');
        
        $status = $this->request->getGet('status');
        $payment_status = $this->request->getGet('payment_status');
        

        $tripsModel = new TripsModel();

        $query = $tripsModel->select('*');

        if ($user && !empty($user)) {
            $query->where('passenger_id', $user);
        }
        if ($driver && !empty($driver)) {
            $query->where('driverID', $driver);
        }
        if ($loc_start && !empty($loc_start)) {
            $query->like('startAdd', $loc_start);
        }
        if ($loc_end && !empty($loc_end)) {
            $query->like('endAdd', $loc_end);
        }
        if ($contact_start_date && !empty($contact_start_date) && $contact_end_date && !empty($contact_end_date)) {
            $query->where('call_date >=', $contact_start_date)
              ->where('call_date <=', $contact_end_date);
        }
        if ($trip_start_date && !empty($trip_start_date) && $trip_end_date && !empty($trip_end_date)) {
            $query->where('trip_date >=', $trip_start_date)
              ->where('trip_date <=', $trip_end_date);
        }
        if ($guest_name && !empty($guest_name)) {
            $query->like('guest_name', $guest_name);
        }
        if ($guest_tel && !empty($guest_tel)) {
            $query->like('guest_tel', $guest_tel);
        }


        if ($status && !empty($status)) {
            $query->where('status', $status);
        }
        if ($payment_status && !empty($payment_status)) {
            $query->where('payment_status', $payment_status);
        }
 

        $data['Trip'] = $query->findAll();

   
        $data['Package'] = (new PackagesModel())->findAll();
        $data['Title']   = 'جستجوی سرویس';


        echo view('parts/header');
        echo view('parts/side');
        echo view('Report/Trips/Result', $data);
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




    public function Print(){
        $user = $this->request->getGet('user');
        $driver = $this->request->getGet('driver');
        $loc_start = $this->request->getGet('loc_start');
        $loc_end = $this->request->getGet('loc_end');
        $contact_start_date = $this->request->getGet('contact_start_date');
        $contact_end_date = $this->request->getGet('contact_end_date');
        $trip_start_date = $this->request->getGet('trip_start_date');
        $trip_end_date = $this->request->getGet('trip_end_date');
        $guest_name = $this->request->getGet('guest_name');
        $guest_tel = $this->request->getGet('guest_tel');
        
        $status = $this->request->getGet('status');
        $payment_status = $this->request->getGet('payment_status');
        

        $tripsModel = new TripsModel();

        $query = $tripsModel->select('*');

        if ($user && !empty($user)) {
            $query->where('passenger_id', $user);
        }
        if ($driver && !empty($driver)) {
            $query->where('driverID', $driver);
        }
        if ($loc_start && !empty($loc_start)) {
            $query->like('startAdd', $loc_start);
        }
        if ($loc_end && !empty($loc_end)) {
            $query->like('endAdd', $loc_end);
        }
        if ($contact_start_date && !empty($contact_start_date) && $contact_end_date && !empty($contact_end_date)) {
            $query->where('call_date >=', $contact_start_date)
              ->where('call_date <=', $contact_end_date);
        }
        if ($trip_start_date && !empty($trip_start_date) && $trip_end_date && !empty($trip_end_date)) {
            $query->where('trip_date >=', $trip_start_date)
              ->where('trip_date <=', $trip_end_date);
        }
        if ($guest_name && !empty($guest_name)) {
            $query->like('guest_name', $guest_name);
        }
        if ($guest_tel && !empty($guest_tel)) {
            $query->like('guest_tel', $guest_tel);
        }


        if ($status && !empty($status)) {
            $query->where('status', $status);
        }
        if ($payment_status && !empty($payment_status)) {
            $query->where('payment_status', $payment_status);
        }
 

        $data['Trip'] = $query->findAll();

   
        $data['Package'] = (new PackagesModel())->findAll();
        $data['Title']   = 'جستجوی سرویس';



        echo view('parts/print/header');
        echo view('Report/Trips/calc', $data);
        echo view('parts/print/footer');
    }

}