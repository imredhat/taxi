<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\TripsModel;
use App\Models\UserModel;
use App\Models\TransactionModel;


class User extends BaseController
{

    public function __construct()
    {
        if (! session()->has('user_id')) {
            header('location:/auth');
            exit();
        }
    }

    public function curlLink($url, $data)
    {

        $data = [
            'hash' => 'your_driver_hash',
            'carID' => 'your_car_id'
        ];

        $options = [
            'http' => [
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents("https://example.com/api/TripsList", false, $context);

        $result = json_decode($response, true);
        print_r($result);
    }

    public function index()
    {
        /*********************** Report Data  **************************/
        
        $data['Report'] = $this->PrintAll();
        $data['lastMonth'] = $this->lastMonth();

        // echo "last month";
        // echo "<pre>";
        // print_r($data['lastMonth']['averageUserCustomFare']);
        // echo "</pre>";
        // echo "Report";
        // echo "<pre>";
        // print_r($data['Report']['averageUserCustomFare']);
        // echo "</pre>";
        // echo "<hr>";
        // echo "<br>";
        // die();


        $data["BestDriver"] = "";

        $db     = \Config\Database::connect();
        $query  = $db->query("SELECT driverID,package, COUNT(driverID) as count FROM trips WHERE driverID != 0 AND trip_date >= '{$data['Report']['start']}' AND trip_date <= '{$data['Report']['end']}' GROUP BY driverID ORDER BY count DESC LIMIT 1 ");
        $result = $query->getRow();

        if ($result) {

            $driverModel        = new \App\Models\DriverModel();
            $driver             = $driverModel->find($result->driverID);
            $data["BestDriver"] = $driver;
            $data["count"]      = $result->count;

            $queryVIP  = $db->query("SELECT COUNT(*) as vip_count FROM trips WHERE package = '.$result->count.'");
            $resultVIP = $queryVIP->getRow();

            $Trip = new TripsModel();
            $trip = $Trip->where('package', $result->package)->countAllResults();

            $data["TotalPackageTrip"] = $trip;
            $data["Package"]          = $result->package;
        }

        
        /*********************** Trips Data  **************************/

        $Trip               = new TripsModel();
        $data["TotalTrips"] = $Trip->countAllResults();

        $queryFare  = $db->query("SELECT AVG(UserCustomFare) as avg_fare FROM trips WHERE UserCustomFare IS NOT NULL AND UserCustomFare != 0 and status='Confirm' AND trip_date >= '{$data['Report']['start']}' AND trip_date <= '{$data['Report']['end']}'");
        $resultFare = $queryFare->getRow();

        $data["UserCustomFare"] = $resultFare ? $resultFare->avg_fare : 0;

        /*********************** Trips Data  **************************/

        $userModel          = new UserModel();
        $data["TotalUsers"] = $userModel->countAllResults();



        

        echo view('parts/header');
        echo view('parts/side');
        echo view('Home', $data);
    }

    public function lastMonth()
    {

        $now = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
        $persianDateFormatter = \IntlDateFormatter::create(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::NONE,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL
        );
        $persianDateFormatter->setPattern('YYYY/MM/dd'); // Set pattern to show month and date with leading zeros
        $data['today'] = $persianDateFormatter->format($now);
        $date = explode('/', $data['today']);
        $year = $date[0];
        $month = $date[1];

        // Convert Persian numbers to English
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        
        $month              = str_replace($persianNumbers, $englishNumbers, $month);
        $year              = str_replace($persianNumbers, $englishNumbers, $year);

        


        



        if(floatval($month) == 1){
            $month = 12;
            $year = floatval($year) - 1;
            
        }else{
            $month = floatval($month) - 1;
            $month = $month < 10 ? '0' . $month : $month;
        }

    


        $trip_start_date = $year . '/' . $month . '/01';
        $trip_end_date   = $year . '/' . $month . '/31';

        $trip_start_date            = str_replace($persianNumbers, $englishNumbers, $trip_start_date);
        $trip_end_date              = str_replace($persianNumbers, $englishNumbers, $trip_end_date);
        
        $data['start'] = $trip_start_date;
        $data['end']   = $trip_end_date;
        




        $status         = "Done";
        $payment_status = "Paid";

        $tripsModel = new TripsModel();
        $query = $tripsModel->select('*');


        $query->where('payment_status', $payment_status);
        $query->where('trip_date >=', $trip_start_date);
        $query->where('trip_date <=', $trip_end_date);
        $query->where('status', $status);


        $AllTrips = $query->findAll();


        $FullTrip = [];
        $totalIn    = 0;
        $totalOut   = 0;
        $bankTotals = [];

        $inCount               = 0;
        $outCount              = 0;
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

        $TransactinModel = new TransactionModel();
        foreach ($AllTrips as $T) {
            $T['Transactions'] = $TransactinModel->TripTrans($T['id']);
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
                } elseif ($transaction['type'] == 'out') {
                    $totalOut += $transaction['amount'];
                }

                $bank_id = $transaction['bank_id'];
                if (! isset($bankTotals[$bank_id])) {
                    $bankTotals[$bank_id] = ['in' => 0, 'out' => 0, 'bank_name' => $transaction['bank_name']];
                }

                if ($transaction['type'] == 'in') {
                    $bankTotals[$bank_id]['in'] += $transaction['amount'];
                } elseif ($transaction['type'] == 'out') {
                    $bankTotals[$bank_id]['out'] += $transaction['amount'];
                }

                if ($transaction['type'] == 'in') {
                    $inCount++;
                } elseif ($transaction['type'] == 'out') {
                    $outCount++;
                }
            }
        }

        $data['totalIn']    = $totalIn;
        $data['totalOut']   = $totalOut;
        $data['bankTotals'] = $bankTotals;
        $data['inCount']    = $inCount;
        $data['outCount']   = $outCount;

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

   
        return $data;
    }




    public function PrintAll()
    {

        $now = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
        $persianDateFormatter = \IntlDateFormatter::create(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::NONE,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL
        );
        $persianDateFormatter->setPattern('YYYY/MM/dd'); // Set pattern to show month and date with leading zeros
        $data['today'] = $persianDateFormatter->format($now);
        $date = explode('/', $data['today']);
        $year = $date[0];
        $month = $date[1];
        $trip_start_date = $year . '/' . $month . '/01';
        $trip_end_date   = $year . '/' . $month . '/31';



        // Convert Persian numbers to English
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $trip_start_date            = str_replace($persianNumbers, $englishNumbers, $trip_start_date);
        $trip_end_date              = str_replace($persianNumbers, $englishNumbers, $trip_end_date);

        $data['start'] = $trip_start_date;
        $data['end']   = $trip_end_date;


        $status         = "Done";
        $payment_status = "Paid";

        $tripsModel = new TripsModel();
        $query = $tripsModel->select('*');


        $query->where('payment_status', $payment_status);
        $query->where('trip_date >=', $trip_start_date);
        $query->where('trip_date <=', $trip_end_date);
        $query->where('status', $status);


        $AllTrips = $query->findAll();


        $FullTrip = [];
        $totalIn    = 0;
        $totalOut   = 0;
        $bankTotals = [];

        $inCount               = 0;
        $outCount              = 0;
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

        $TransactinModel = new TransactionModel();
        foreach ($AllTrips as $T) {
            $T['Transactions'] = $TransactinModel->TripTrans($T['id']);
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
                } elseif ($transaction['type'] == 'out') {
                    $totalOut += $transaction['amount'];
                }

                $bank_id = $transaction['bank_id'];
                if (! isset($bankTotals[$bank_id])) {
                    $bankTotals[$bank_id] = ['in' => 0, 'out' => 0, 'bank_name' => $transaction['bank_name']];
                }

                if ($transaction['type'] == 'in') {
                    $bankTotals[$bank_id]['in'] += $transaction['amount'];
                } elseif ($transaction['type'] == 'out') {
                    $bankTotals[$bank_id]['out'] += $transaction['amount'];
                }

                if ($transaction['type'] == 'in') {
                    $inCount++;
                } elseif ($transaction['type'] == 'out') {
                    $outCount++;
                }
            }
        }

        $data['totalIn']    = $totalIn;
        $data['totalOut']   = $totalOut;
        $data['bankTotals'] = $bankTotals;
        $data['inCount']    = $inCount;
        $data['outCount']   = $outCount;

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

   
        return $data;
    }

    public function Company()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('company');
        $crud->setSubject('شرکت');
        $crud->unsetRead();

        $crud->requiredFields(['name']);
        $crud->columns(['cid', 'name', 'logo', 'address', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'website', 'industry', 'description']);
        $crud->fields(['name', 'logo', 'address', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'website', 'industry', 'description']);
        $crud->displayAs('cid', 'شناسه');
        $crud->displayAs('name', 'نام شرکت');
        $crud->displayAs('address', 'آدرس');
        $crud->displayAs('city', 'شهر');
        $crud->displayAs('state', 'استان');
        $crud->displayAs('zip', 'کد پستی');
        $crud->displayAs('phone', 'تلفن');
        $crud->displayAs('fax', 'فکس');
        $crud->displayAs('email', 'ایمیل');
        $crud->displayAs('website', 'وب سایت');
        $crud->displayAs('industry', 'نوع شرکت');
        $crud->displayAs('description', 'توضیحات');
        $crud->displayAs('logo', 'لوگو');

        $this->CompanyUploadCallback($crud, 'logo');

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }

    public function AllUser()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable(tableName: 'user');
        $crud->setSubject('کاربران', 'کاربر');
        $crud->setRead();

        // $crud->setActionButton('کارت مشترک', 'fa fa-user UserTab', function ($row) {
        //     return '/UserCard/' . $row;
        // }, true);

        $crud->setActionButton('کارت مشترک', 'fa-user UserTab', function ($row) {
            return 'UserCard/' . $row;
        }, true, "UserTab");

        $crud->requiredFields(['name']);
        $crud->columns([
            'ax',
            'id',
            'name',
            'lname',
            'gender',
            'mobile',
            'type',
            'company_name',
            'status',
            'date_start',
        ]);

        $crud->fields([
            'ax',
            'name',
            'lname',
            'gender',
            'mobile',
            'phone',
            'type',
            'company_name',
            'status',
            'date_start',
        ]);

        $crud->displayAs([
            'id'           => 'شناسه',
            'name'         => 'نام',
            'lname'        => 'نام خانوادگی',
            'gender'       => 'جنسیت',
            'mobile'       => 'موبایل',
            'phone'        => 'تلفن',
            'type'         => 'نوع اشتراک',
            'status'       => 'وضعیت',
            'ax'           => 'تصویر شخص / شرکت',
            'created_at'   => 'تاریخ ثبت',
            'updated_at'   => 'تاریخ بروزرسانی',
            'deleted_at'   => 'تاریخ حذف',
            'date_start'   => 'شروع اشتراک',
            'company_name' => 'نام شرکت',
        ]);

        $crud->fieldType('gender', 'dropdown', [
            ''    => 'انتخاب جنسیت',
            'مرد' => 'مرد',
            'زن'  => 'زن',
        ]);

        $crud->fieldType('type', 'dropdown', [
            ''      => 'انتخاب جنسیت',
            'حقیقی' => 'حقیقی',
            'حقوقی' => 'حقوقی',
        ]);

        $crud->fieldType('status', 'dropdown', [
            ''           => 'انتخاب وضعیت',
            'تایید شده'  => 'تایید شده',
            'تایید نشده' => 'تایید نشده',
        ]);

        // $crud->callbackColumn('created_at', function ($value) {

        //     if (!empty($value)) {
        //         $date = new PersianDate();
        //         list($gy, $gm, $gd) = explode('-', substr($value, 0, 10));
        //         return $date->gregorianToJalali($gy, $gm, $gd, '/');
        //     } else {
        //         return $value->created_at;
        //     }

        // });

        $this->UploadCallback($crud, 'ax');

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }

    public function CompanyUploadCallback($crud, $field)
    {
        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            return '<img src="' . base_url('uploads/company/' . $data->cid . '/' . $data->logo) . '" width="100" height="200">';
        });

        $crud->callbackEditField($field, function ($row, $pid) use ($field) {

            // print_r($pid);die();
            if (! empty($row)) {
                return '<img src="' . base_url('uploads/company/' . $pid . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "LO/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['logo'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                    if (! file_exists(base_url('uploads/company/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('uploads/company/' . $stateParameters->primaryKeyValue, $file->getName());
                            $stateParameters->data[$field] = $file->getName();
                        }
                    }
                }
            }

            return $stateParameters;
        });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $file = $this->request->getFile('ax');
            if (isset($file)) {
                if (! file_exists(base_url('uploads/company/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/company/', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (! file_exists(base_url('uploads/company/' . $scan->getName()))) {
                    if ($scan->isValid()) {
                        $scan->move('uploads/company/', $scan->getName());
                        $stateParameters->data['scan_melli'] = $scan->getName();
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }

    public function UploadCallback($crud, $field)
    {
        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            return '<img src="' . base_url('uploads/user/' . $data->id . '/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackEditField($field, function ($row, $pid) use ($field) {

            if (! empty($row)) {
                return '<img src="' . base_url('uploads/user/' . $pid . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RU/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['ax'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                    if (! file_exists(base_url('uploads/user/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('uploads/user/' . $stateParameters->primaryKeyValue, $file->getName());
                            $stateParameters->data[$field] = $file->getName();
                        }
                    }
                }
            }

            return $stateParameters;
        });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $file = $this->request->getFile('ax');
            if (isset($file)) {
                if (! file_exists(base_url('uploads/user/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/user/', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (! file_exists(base_url('uploads/user/' . $scan->getName()))) {
                    if ($scan->isValid()) {
                        $scan->move('uploads/user/', $scan->getName());
                        $stateParameters->data['scan_melli'] = $scan->getName();
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }

    public function UserCard()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(2);

        $User         = new UserModel();
        $User         = $User->where('id', $ID)->find()[0];
        $data['user'] = $User;

        echo view('parts/print/header');
        echo view('user_card', $data);
        echo view('parts/print/footer');
    }

    public function LO()
    {
        $uri      = service('uri');
        $segment2 = $uri->getSegment(2);
        $segment3 = $uri->getSegment(3);

        if ($segment2 == 'logo') {

            $db      = \Config\Database::connect();
            $builder = $db->table('company');
            $builder->where('cid', $segment3);
            $query = $builder->get();

            if ($query->getNumRows() > 0) {

                $file = 'uploads/company/' . $segment3 . '/' . $query->getResultArray()[0][$segment2];

                if ($segment2 == 'logo') {
                    $builder->set('logo', '');
                    $builder->where('cid', $segment3);
                    $builder->update();
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                return redirect()->back()->with('success', 'Field updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Driver not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid field type.');
        }
    }

    public function getAllUser()
    {
        $User = new UserModel();
        $data = $User->select('id, name, lname')->findAll();

        return $this->response->setJSON($data);
    }

    public function RD()
    {
        $uri      = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);

        if ($segment3 == 'ax') {

            $db      = \Config\Database::connect();
            $builder = $db->table('user');
            $builder->where('id', $segment4);
            $query = $builder->get();

            if ($query->getNumRows() > 0) {

                $file = 'uploads/user/' . $segment3 . '/' . $query->getResultArray()[0][$segment3];

                if ($segment3 == 'ax') {
                    $builder->set('ax', '');
                    $builder->where('id', $segment4);
                    $builder->update();
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                return redirect()->back()->with('success', 'Field updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Driver not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid field type.');
        }
    }
}
