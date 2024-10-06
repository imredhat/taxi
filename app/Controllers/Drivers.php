<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;

class Drivers extends BaseController
{

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
        $Brand = new BrandModel();
        $data['Brands'] = $Brand ->orderBy('brand')->withDeleted()->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('driver_add',$data);
        echo view('parts/footer');
    }

    public function AddDriver()
    {
        $Brand = new BrandModel();
        $data['Brands'] = $Brand ->orderBy('brand')->withDeleted()->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('driver_add',$data);
        echo view('parts/footer');
    }

    public function AddDriverToDatabase()
    {
        // Load the database library
        $db = \Config\Database::connect();

        // Get data from POST request
        $name = $this->request->getPost('name');
        $l_name = $this->request->getPost('l_name');
        $address = $this->request->getPost('address');
        $phone = $this->request->getPost('phone');
        $mobile = $this->request->getPost('mobile');

        // Check if phone number is unique
        $builder = $db->table('drivers');
        $builder->where('phone', $phone);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            // Phone number already exists
            return redirect()->back()->with('error', 'Phone number already exists.');
        } else {
            // Insert data into drivers table
            $data = [
                'name' => $name,
                'l_name' => $l_name,
                'address' => $address,
                'phone' => $phone,
                'mobile' => $mobile
            ];

            $builder->insert($data);

            return redirect()->back()->with('success', 'Driver added successfully.');
        }
    }



    public function All()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('driver');
        $crud->setSubject('راننده', 'رانندگان');
        // $crud->unsetRead();
        $crud->columns(['did', 'ax', 'name', 'lname', 'gender', 'mobile', 'work_type', 'date_created']);
        $crud->fields(['name', 'lname', 'gender', 'mobile', 'mobile2', 'phone', 'address', 'work_type', 'melli', 'bank', 'scan_melli', 'ax']);
        $crud->displayAs('did', "شناسه");
        $crud->displayAs('name', "نام");
        $crud->displayAs('lname', "نام خانوادگی");
        $crud->displayAs('gender', "جنسیت");
        $crud->displayAs('mobile', "موبایل");
        $crud->displayAs('mobile2', "موبایل دوم");
        $crud->displayAs('phone', "تلفن");
        $crud->displayAs('address', "آدرس");
        $crud->displayAs('work_type', "نوع کار");
        $crud->displayAs('melli', "کد ملی");
        $crud->displayAs('scan_melli', "اسکن کارت ملی");
        $crud->displayAs('bank', "شماره کارت بانکی");
        $crud->displayAs('date_created', "تاریخ ایجاد");
        $crud->displayAs('ax', "تصویر پرسنلی");

        $crud->fieldType("gender", "dropdown", ["male" => "مرد", "female" => "زن"]);
        $crud->fieldType("work_type", "dropdown", ["azad" => "ازاد", "sherkati" => "شرکتی"]);


        $this->UploadCallback($crud, 'ax');
        $this->UploadCallback($crud, 'scan_melli');


        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }



    function UploadCallback($crud, $field)
    {


        $crud->callbackColumn($field, function ($row) use ($field) {
            return '<img src="' . base_url('uploads/drivers/' . $field . '/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackAddField($field, function () use ($field) {
            return ' <input name="' . $field . '" id="file-upload" type="file"> <div id="drop_zone"></div>
            <div id="progress"></div> ';
        });


        $crud->callbackEditField($field, function ($row, $pid) use ($field) {
            if (!empty($row)) {
                return '<img src="' . base_url('uploads/drivers/' . $field . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RD/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $file = $this->request->getFile('ax');
            if (isset($file)) {
                if (!file_exists(base_url('uploads/drivers/ax/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/drivers/ax', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (!file_exists(base_url('uploads/drivers/scan_melli/' . $scan->getName()))) {
                    if ($scan->isValid()) {
                        $scan->move('uploads/drivers/scan_melli', $scan->getName());
                        $stateParameters->data['scan_melli'] = $scan->getName();
                    }
                }
            }

            return $stateParameters;
        });




        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $file = $this->request->getFile('ax');
            if (isset($file)) {
                if (!file_exists(base_url('uploads/drivers/ax/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/drivers/ax', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (!file_exists(base_url('uploads/drivers/scan_melli/' . $scan->getName()))) {
                    if ($scan->isValid()) {
                        $scan->move('uploads/drivers/scan_melli', $scan->getName());
                        $stateParameters->data['scan_melli'] = $scan->getName();
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }



    public function RD()
    {
        $uri = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);




        if ($segment3 == 'ax' || $segment3 == 'scan_melli') {

            $db = \Config\Database::connect();
            $builder = $db->table('driver');
            $builder->where('did', $segment4);
            $query = $builder->get();


            if ($query->getNumRows() > 0) {

                $file = 'uploads/drivers/' . $segment3 . '/' . $query->getResultArray()[0][$segment3];

                if ($segment3 == 'ax') {
                    $builder->set('ax', '');
                    $builder->where('did', $segment4);
                    $builder->update();
                    unlink($file);
                } elseif ($segment3 == 'scan_melli') {
                    $builder->set('scan_melli', '');
                    $builder->where('did', $segment4);
                    $builder->update();
                    unlink($file);
                }
                return redirect()->back()->with('success', 'Field updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Driver not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid field type.');
        }
    }

    public function OneStep()
    {
        // Load the form validation library



        // Validation successful, insert data into database

        $driver = [
            'gender'                => $this->request->getPost('gender'),
            'name'                  => $this->request->getPost('first_name'),
            'lname'                 => $this->request->getPost('last_name'),
            'mobile'                => $this->request->getPost('mobile'),
            'mobile2'               => $this->request->getPost('mobile_2'),
            'phone'                 => $this->request->getPost('phone'),
            'address'               => $this->request->getPost('address'),
            'melli'                 => $this->request->getPost('national_id'),
            'cooperation_type'      => $this->request->getPost('cooperation_type'),
            'bank_card_number'      => $this->request->getPost('bank_card_number'),
            'shaba'                 => $this->request->getPost('iban'),
            'note'                  => $this->request->getPost('notes'),
            'ax'                    => $this->upload_file('ax', type: "drivers"),
            'scan_melli'            => $this->upload_file('scan_melli', type: "drivers")
        ];

        // print_r($driver);
        // die();

        $Driver = new DriverModel();

        if ($Driver->insert($driver)) {
            $DID = $Driver->getInsertID();


            $car = array(
                'driver_id'        => $DID,
                'brand'            => $this->request->getPost('brand'),
                'iran'             => $this->request->getPost('plate_part1'),
                'pelak'            => $this->request->getPost('plate_part2'),
                'pelak_last'       => $this->request->getPost('plate_part3'),
                'harf'             => $this->request->getPost('plate_letter'),
                'fuel'             => $this->request->getPost('fuel_type'),
                'type'             => $this->request->getPost('car_type'),
                'vin'              => $this->request->getPost('vin'),
                'motor'            => $this->request->getPost('engine_id'),
                'shasi'            => $this->request->getPost('chassis_number'),
                'scan_car_id'      => $this->upload_file('scan_car_id', "cars"),
                'pic_back'         => $this->upload_file('pic_back', "cars"),
                'pic_front'        => $this->upload_file('pic_front', type: "cars"),
                'pic_in_back'      => $this->upload_file('pic_in_back', "cars"),
                'pic_in_front'     => $this->upload_file('pic_in_front', "cars"),
            );

            $Car = new CarModel();
            $Car->insert($car);

            // Redirect to a success page
            return redirect()->to('all-drivers');
        }
    }

    private function upload_file($field_name, $type)
    {
        $file = $this->request->getFile($field_name);
        if (!empty($file)) {
            $config = [
                'uploadPath' => './uploads/' . $type . "/" . $field_name,
                'allowedTypes' => 'jpg|jpeg|png',
                'maxSize' => 1024,
            ];
            if ($file->isValid()) {
                if (!$file->move($config['uploadPath'])) {
                    $error = array('error' => 'Failed to upload file');
                    return $error;
                }

                return $file->getName();
            }
        }
    }




}
