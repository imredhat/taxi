<?php
namespace App\Controllers;

use App\Models\BankModel;
use App\Models\DriverModel;
use App\Models\PackagesModel;
use App\Models\TransactionModel;
use App\Models\TripsModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Report extends ResourceController
{
    protected $modelName = \App\Models\TripsModel::class;
    protected $format    = 'json';

    public function All()
    {

        $data['User']    = (new UserModel())->findAll();
        $data['Drivers'] = (new DriverModel())->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('Report/All/index', $data);
        echo view('parts/footer');
    }

    public function Search()
    {
        $user               = $this->request->getGet('user');
        $driver             = $this->request->getGet('driver');
        $loc_start          = $this->request->getGet('loc_start');
        $loc_end            = $this->request->getGet('loc_end');
        $contact_start_date = $this->request->getGet('contact_start_date');
        $contact_end_date   = $this->request->getGet('contact_end_date');
        $trip_start_date    = $this->request->getGet('trip_start_date');
        $trip_end_date      = $this->request->getGet('trip_end_date');
        $guest_name         = $this->request->getGet('guest_name');
        $guest_tel          = $this->request->getGet('guest_tel');

        $status         = $this->request->getGet('status');
        $payment_status = $this->request->getGet('payment_status');

        $tripsModel = new TripsModel();

        $query = $tripsModel->select('*');

        if ($user && ! empty($user)) {
            $query->where('passenger_id', $user);
        }
        if ($driver && ! empty($driver)) {
            $query->where('driverID', $driver);
        }
        if ($loc_start && ! empty($loc_start)) {
            $query->like('startAdd', $loc_start);
        }
        if ($loc_end && ! empty($loc_end)) {
            $query->like('endAdd', $loc_end);
        }
        if ($contact_start_date && ! empty($contact_start_date) && $contact_end_date && ! empty($contact_end_date)) {
            $query->where('call_date >=', $contact_start_date)
                ->where('call_date <=', $contact_end_date);
        }
        if ($trip_start_date && ! empty($trip_start_date) && $trip_end_date && ! empty($trip_end_date)) {
            $query->where('trip_date >=', $trip_start_date)
                ->where('trip_date <=', $trip_end_date);
        }
        if ($guest_name && ! empty($guest_name)) {
            $query->like('guest_name', $guest_name);
        }
        if ($guest_tel && ! empty($guest_tel)) {
            $query->like('guest_tel', $guest_tel);
        }

        if ($status && ! empty($status)) {
            $query->where('status', $status);
        }
        if ($payment_status && ! empty($payment_status)) {
            $query->where('payment_status', $payment_status);
        }

        $data['Trip'] = $query->findAll();

        $data['Package'] = (new PackagesModel())->findAll();
        $Banks           = new BankModel();

        $data['bnks'] = $Banks->where('active', '1')->findAll();

        $data['Title'] = 'جستجوی سرویس';

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

    public function PrintAll()
    {
        $user               = $this->request->getGet('user');
        $driver             = $this->request->getGet('driver');
        $loc_start          = $this->request->getGet('loc_start');
        $loc_end            = $this->request->getGet('loc_end');
        $contact_start_date = $this->request->getGet('contact_start_date');
        $contact_end_date   = $this->request->getGet('contact_end_date');
        $trip_start_date    = $this->request->getGet('trip_start_date');
        $trip_end_date      = $this->request->getGet('trip_end_date');
        $guest_name         = $this->request->getGet('guest_name');
        $guest_tel          = $this->request->getGet('guest_tel');

        $status         = $this->request->getGet('status');
        $payment_status = $this->request->getGet('payment_status');

        $tripsModel = new TripsModel();

        $query = $tripsModel->select('*');

        if ($user && ! empty($user)) {
            $query->where('passenger_id', $user);
        }
        if ($driver && ! empty($driver)) {
            $query->where('driverID', $driver);
        }
        if ($loc_start && ! empty($loc_start)) {
            $query->like('startAdd', $loc_start);
        }
        if ($loc_end && ! empty($loc_end)) {
            $query->like('endAdd', $loc_end);
        }
        if ($contact_start_date && ! empty($contact_start_date) && $contact_end_date && ! empty($contact_end_date)) {
            $query->where('call_date >=', $contact_start_date)
                ->where('call_date <=', $contact_end_date);
        }
        if ($trip_start_date && ! empty($trip_start_date) && $trip_end_date && ! empty($trip_end_date)) {
            $query->where('trip_date >=', $trip_start_date)
                ->where('trip_date <=', $trip_end_date);
        }
        if ($guest_name && ! empty($guest_name)) {
            $query->like('guest_name', $guest_name);
        }
        if ($guest_tel && ! empty($guest_tel)) {
            $query->like('guest_tel', $guest_tel);
        }

        if ($status && ! empty($status)) {
            $query->where('status', $status);
        }
        if ($payment_status && ! empty($payment_status)) {
            $query->where('payment_status', $payment_status);
        }

        $AllTrips = $query->findAll();
        $FullTrip = [];

        $totalIn    = 0;
        $totalOut   = 0;
        $totalRef   = 0; 
        $bankTotals = [];

        $inCount               = 0;
        $outCount              = 0;
        $RefCount              = 0;
        $totalUserCustomFare   = 0;
        $totalDriverCustomFare = 0;
        $userCustomFareCount   = 0;
        $driverCustomFareCount = 0;

        $maxUserCustomFare   = 0;
        $minUserCustomFare   = PHP_INT_MAX;
        $maxDriverCustomFare = 0;
        $minDriverCustomFare = PHP_INT_MAX;

        $maxUserCustomFareTrip   = 0;
        $maxUserCustomFareUser   = 0;
        $maxUserCustomFareDriver = 0;
        $minUserCustomFareTrip   = 0;
        $minUserCustomFareUser   = 0;
        $minUserCustomFareDriver = 0;

        $Called    = 0;
        $Reserved  = 0;
        $Notifed   = 0;
        $Requested = 0;
        $Done      = 0;
        $Confirm   = 0;
        $Cancled   = 0;
        $Service   = 0;
        $AllType   = 0;
        $TotalServicePrice = 0;

        $TransactinModel = new TransactionModel();
        foreach ($AllTrips as $T) {
            $T['Transactions'] = $TransactinModel->TripTrans($T['id']);
            $TotalServicePrice = $TotalServicePrice + $T['userCustomFare'];

            array_push($FullTrip, $T);

            if (isset($T['status'])) {
                switch ($T['status']) {
                    case 'Called':
                        $Called++;
                        break;
                    case 'Reserved':
                        $Reserved++;
                        break;
                    case 'Notifed':
                        $Notifed++;
                        break;
                    case 'Requested':
                        $Requested++;
                        break;
                    case 'Done':
                        $Done++;
                        break;
                    case 'Confirm':
                        $Confirm++;
                        break;
                    case 'Service':
                        $Service++;
                        break;
                    case 'Cancled':
                        $Cancled++;
                        break;
                }
            }

            foreach ($FullTrip as $trip) {
                if (isset($trip['userCustomFare'])) {
                    $totalUserCustomFare += $trip['userCustomFare'];
                    $userCustomFareCount++;
                    if ($trip['userCustomFare'] > $maxUserCustomFare) {
                        $maxUserCustomFare       = $trip['userCustomFare'];
                        $maxUserCustomFareTrip   = $trip['id'];
                        $maxUserCustomFareUser   = $trip['passenger_id'];
                        $maxUserCustomFareDriver = $trip['driverID'];
                    }
                    if ($trip['userCustomFare'] < $minUserCustomFare) {
                        $minUserCustomFare       = $trip['userCustomFare'];
                        $minUserCustomFareTrip   = $trip['id'];
                        $minUserCustomFareUser   = $trip['passenger_id'];
                        $minUserCustomFareDriver = $trip['driverID'];
                    }
                }
                if (isset($trip['driverCustomFare'])) {
                    $totalDriverCustomFare += $trip['driverCustomFare'];
                    $driverCustomFareCount++;

                    if ($trip['driverCustomFare'] > $maxDriverCustomFare) {
                        $maxDriverCustomFare     = $trip['driverCustomFare'];
                        $maxUserCustomFareTrip   = $trip['id'];
                        $maxUserCustomFareUser   = $trip['passenger_id'];
                        $maxUserCustomFareDriver = $trip['driverID'];
                    }
                    if ($trip['driverCustomFare'] < $minDriverCustomFare) {
                        $minDriverCustomFare     = $trip['driverCustomFare'];
                        $minUserCustomFareTrip   = $trip['id'];
                        $minUserCustomFareUser   = $trip['passenger_id'];
                        $minUserCustomFareDriver = $trip['driverID'];
                    }
                }

                // $AllType++;

               
            }

            foreach ($T['Transactions'] as $transaction) {
                if ($transaction['type'] == 'in') {
                    $totalIn += $transaction['amount'];
                }
                if ($transaction['type'] == 'out') {
                    $totalOut += $transaction['amount'];
                }
                if ($transaction['type'] == 'ref') {
                    $totalRef += $transaction['amount'];
                }
      

                $bank_id = $transaction['bank_id'];
                if (! isset($bankTotals[$bank_id])) {
                    $bankTotals[$bank_id] = ['in' => 0, 'out' => 0, 'bank_name' => $transaction['bank_name']];
                }

                if ($transaction['type'] == 'in') {
                    $bankTotals[$bank_id]['in'] += $transaction['amount'];
                } 
                elseif ($transaction['type'] == 'ref') {
                    $bankTotals[$bank_id]['ref'] += $transaction['amount'];
                }
                if ($transaction['type'] == 'out') {
                    $bankTotals[$bank_id]['out'] += $transaction['amount'];
                }

                if ($transaction['type'] == 'in') {
                    $inCount++;
                } 
                if ($transaction['type'] == 'out') {
                    $outCount++;
                }
                if ($transaction['type'] == 'ref') {
                    $RefCount++;
                }

            }

        }

        $data['totalIn']    = $totalIn;
        $data['totalOut']   = $totalOut;
        $data['totalRef']   = $totalRef;
        $data['bankTotals'] = $bankTotals;
        $data['inCount']    = $inCount;
        $data['outCount']   = $outCount;
        $data['RefCount']   = $RefCount;
        $data['TotalServicePrice']   = $TotalServicePrice;

        $data['averageUserCustomFare']   = $userCustomFareCount ? $totalUserCustomFare / $userCustomFareCount : 0;
        $data['averageDriverCustomFare'] = $driverCustomFareCount ? $totalDriverCustomFare / $driverCustomFareCount : 0;

        $data['maxUserCustomFare']   = $maxUserCustomFare;
        $data['minUserCustomFare']   = $minUserCustomFare == PHP_INT_MAX ? 0 : $minUserCustomFare;
        $data['maxDriverCustomFare'] = $maxDriverCustomFare;
        $data['minDriverCustomFare'] = $minDriverCustomFare == PHP_INT_MAX ? 0 : $minDriverCustomFare;

        $data['maxUserCustomFareTrip']   = $maxUserCustomFareTrip;
        $data['maxUserCustomFareUser']   = $maxUserCustomFareUser;
        $data['maxUserCustomFareDriver'] = $maxUserCustomFareDriver;

        $data['minUserCustomFareTrip']   = $minUserCustomFareTrip;
        $data['minUserCustomFareUser']   = $minUserCustomFareUser;
        $data['minUserCustomFareDriver'] = $minUserCustomFareDriver;

        $data['status']['Called']    = $Called;
        $data['status']['Reserved']  = $Reserved;
        $data['status']['Notifed']   = $Notifed;
        $data['status']['Requested'] = $Requested;
        $data['status']['Done']      = $Done;
        $data['status']['Confirm']   = $Confirm;
        $data['status']['Cancled']   = $Cancled;
        $data['status']['Service']   = $Service;
        $data['AllType']             = count($AllTrips);

        // echo json_encode($data);die();

        $data['Trip'] = $FullTrip;

        $data['Package'] = (new PackagesModel())->findAll();
        $data['Title']   = 'جستجوی سرویس';

        echo view('parts/print/header');
        echo view('Report/All/calc', $data);
        echo view('parts/print/footer');
    }

    public function Drivers()
    {
        $requestModel = new \App\Models\RequestModel();

        $AllDriver = [];
        $drivers   = (new \App\Models\DriverModel())->findAll();
        foreach ($drivers as $driver) {
            $driverID                   = $driver['did'];
            $driver['AcceptedRequests'] = $requestModel->where('driverID', $driverID)->where('isAccepted', 'YES')->countAllResults();
            $driver['RejectedRequests'] = $requestModel->where('driverID', $driverID)->where('isAccepted', 'NO')->countAllResults();
            $driver['TotalRequests']    = $requestModel->where('driverID', $driverID)->countAllResults();

            array_push($AllDriver, $driver);
        }

        // echo json_encode($AllDriver);die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('Report/Drivers/index', ['Drivers' => $AllDriver]);
        echo view('parts/footer');
    }

}
