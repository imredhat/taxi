<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Libraries\PersianDate;
use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;

class Drivers extends BaseController
{
    public function index()
    {



        $Brand          = new BrandModel();
        $data['Brands'] = $Brand->orderBy('brand')->withDeleted()->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('driver_add', $data);
        echo view('parts/footer');
    }

    public function AddDriver()
    {
        $Brand          = new BrandModel();
        $data['Brands'] = $Brand->orderBy('brand')->withDeleted()->findAll();
        // $data['Type'] = $Brand->orderBy('brand_type')->withDeleted()->findAll();

        echo view('parts/header');
        echo view('parts/side');
        echo view('driver_add', $data);
        echo view('parts/footer');
    }

    public function AddDriverToDatabase()
    {
        $db = \Config\Database::connect();

        $name    = $this->request->getPost('name');
        $l_name  = $this->request->getPost('l_name');
        $address = $this->request->getPost('address');
        $phone   = $this->request->getPost('phone');
        $mobile  = $this->request->getPost('mobile');

        $builder = $db->table('drivers');
        $builder->where('phone', $phone);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            // Phone number already exists
            return redirect()->back()->with('error', 'Phone number already exists.');
        } else {
            // Insert data into drivers table
            $data = [
                'name'    => $name,
                'l_name'  => $l_name,
                'address' => $address,
                'phone'   => $phone,
                'mobile'  => $mobile,
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
        $crud->unsetAdd();
        // $crud->setRead();

        $crud->setActionButton('', 'fa-credit-card', function ($row) {
            return 'DriverCard/' . $row;
        }, true, "DriverTab");

        $crud->setActionButton('', 'fa-info-circle', function ($row) {
            return 'Driver/Info/' . $row;
        }, true, "Info");

        $crud->setActionButton('', 'fa-car', function ($row) {
            return 'Driver/Cars/' . $row;
        }, true);

        $crud->columns(['code', 'ax', 'name', 'lname', 'gender', 'mobile', 'melli', 'date_created','status']);
        $crud->fields(['code', 'ax', 'name', 'lname', 'gender', 'mobile', 'mobile2', 'password', 'birthday', 'phone', 'address', 'melli', 'scan_melli', 'scan_govahiname', 'bank', 'shaba', 'education_level', 'foreign_language', 'foreign_language_proficiency', 'postal_code', 'note', 'status']);

        $crud->displayAs('ax', 'عکس')
            ->displayAs('name', 'نام')
            ->displayAs('lname', 'نام خانوادگی')
            ->displayAs('gender', 'جنسیت')
            ->displayAs('mobile', 'موبایل')
            ->displayAs('mobile2', 'موبایل دوم')
            ->displayAs('password', 'رمز عبور')
            ->displayAs('birthday', 'تاریخ تولد')
            ->displayAs('phone', 'تلفن')
            ->displayAs('address', 'آدرس')
            ->displayAs('work_type', 'نوع کار')
            ->displayAs('melli', 'کد ملی')
            ->displayAs('scan_melli', 'اسکن کارت ملی')
            ->displayAs('scan_govahiname', 'اسکن گواهینامه')
            ->displayAs('bank', 'شماره کارت بانکی')
            ->displayAs('shaba', 'شماره شبا')
            ->displayAs('education_level', 'سطح تحصیلات')
            ->displayAs('foreign_language', 'زبان خارجی')
            ->displayAs('foreign_language_proficiency', 'مهارت زبان خارجی')
            ->displayAs('postal_code', 'کد پستی')
            ->displayAs('note', 'یادداشت')
            ->displayAs('code', 'شناسه')
            ->displayAs('date_created', 'تاریخ ثبت')
            ->displayAs('status', 'وضعیت');

        $crud->fieldType("gender", "dropdown", ["مرد" => "مرد", "زن" => "زن"]);
        $crud->fieldType("password", "password");
        $crud->fieldType("work_type", "dropdown", ["ازاد" => "ازاد", "شرکتی" => "شرکتی"]);

        $crud->fieldType("status", "dropdown", ["فعال" => "فعال", "غیرفعال" => "غیرفعال"]);

        $crud->callbackAfterUpdate(function ($stateParameters) {
            if ($stateParameters->data['status'] == 'فعال') {
                // Your code here for when status is 'فعال'
                // For example, you can log the update or send a notification

                $values = [
                    'name' => $stateParameters->data['name'].' '.$stateParameters->data['lname'],
                    'user' => $stateParameters->data['mobile'],
                    'pass' => 'رمز انتخابی',
                ];

                $this -> SendSMS($stateParameters->data['mobile'] , $values, 'i5ho4846mtx99sa');


            }
            return $stateParameters;
        });

        $crud->fieldType("education_level", "dropdown", [
            "دیپلم"         => "دیپلم",
            "کاردانی"       => "کاردانی",
            "کارشناسی"      => "کارشناسی",
            "کارشناسی ارشد" => "کارشناسی ارشد",
            "دکتری"         => "دکتری",
        ]);

        $crud->fieldType("foreign_language_proficiency", "dropdown", [
            "مبتدی"   => "مبتدی",
            "متوسط"   => "متوسط",
            "پیشرفته" => "پیشرفته",
        ]);

        $this->UploadCallback($crud, 'ax');
        $this->UploadCallback($crud, 'scan_melli');
        $this->UploadCallback($crud, 'scan_govahiname');

        $crud->callbackAfterDelete(function ($primaryKey) {
            // Your code here for after delete
            // For example, you can log the deletion or perform other actions

                // Remove driver cars
                $carModel = new CarModel();
                if ($carModel->where('driver_id', $primaryKey -> primaryKeyValue)->countAllResults() > 0) {
                    $carModel->where('driver_id', $primaryKey -> primaryKeyValue)->delete();
                }

                // Remove all driver image folders
                $driverImageFolder = './uploads/drivers/' . $primaryKey -> primaryKeyValue;
                if (is_dir($driverImageFolder)) {
                    array_map('unlink', glob("$driverImageFolder/*.*"));
                    rmdir($driverImageFolder);
                }

            return true;
        });



        // $crud->callbackColumn('date_created', function ($value) {
        //     $date               = new PersianDate();
        //     list($gy, $gm, $gd) = explode('-', substr($value, 0, 10));
        //     return $date->gregorianToJalali($gy, $gm, $gd, '/');
        // });

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }

    private function sendSMS($recipient , $values , $patternCode)
    {
        $client = new \Pishran\IpPanel\Client('SA11ECEv6ZmVGJbalKfGGhGcLKjXNA00fxoN5DMoFPs=');

        $originator  = '+983000505';      // شماره فرستنده


        // $bulkId = $client->sendPattern($patternCode, $originator, $recipient, $values);

        try {
            $result = $client->sendPattern($patternCode, $originator, $recipient, $values);
            if ($result) {
                return "OK";
            } else {
                return "NOK";
            }
        } catch (Exception $e) {
            return "failed";
        }
    }

    private static function hashPasswordBeforeUpdate($stateParameters)
    {
        if (! empty($stateParameters->data['password'])) {
            $stateParameters->data['password'] = password_hash($stateParameters->data['password'], PASSWORD_DEFAULT);
        } else {
            unset($stateParameters->data['password']);
        }
        return $stateParameters;
    }

    /*---------------------------------------------------------\
      |                   Driver Card
      |---------------------------------------------------------/
     */

    public function DriverCard()
    {
        $uri = service('uri');
        $ID  = $uri->getSegment(2);

        $Driver         = new DriverModel();
        $Driver         = $Driver->where('did', $ID)->find()[0];
        $data['driver'] = $Driver;

        $Cars        = new CarModel();
        $Cars        = $Cars->GetDriverCars($ID);
        $data['car'] = $Cars;

        // echo "<pre>";
        // print_r($data);
        // die();

        echo view('parts/print/header');
        echo view('driver_card', $data);
        echo view('parts/print/footer');
    }

    public function Info($ID)
    {

        $uri = service('uri');
        $ID  = $uri->getSegment(3);

        $Driver         = new DriverModel();
        $data['Driver'] = $Driver->where('did', $ID)->first();

        $Car          = new CarModel();
        $data['cars'] = $Car->getAllCarsWithLinkedData($ID);

        // echo $ID;

        // echo "<pre>";
        // print_r($data);
        // die();

        // echo json_encode( $data['cars']);
        // die();

        echo view('parts/print/header');
        echo view('driver_info', $data);
        echo view('parts/print/footer');
    }

    public function UploadCallback($crud, $field)
    {

        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            return '<img src="' . base_url('uploads/drivers/' . $data->did . '/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackEditField($field, function ($row, $pid) use ($field) {

            if (! empty($row)) {
                return '<img src="' . base_url('uploads/drivers/' . $pid . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RD/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['scan_melli', 'scan_govahiname', 'ax'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {

                    if (! file_exists(base_url('uploads/drivers/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('uploads/drivers/' . $stateParameters->primaryKeyValue, $file->getName());
                            $stateParameters->data[$field] = $file->getName();

                            // print_r($stateParameters);
                            // die();
                        }
                    }
                }
            }

            if (! empty($stateParameters->data['password'])) {

                if (! password_get_info($stateParameters->data['password'])['algo']) {

                    $password                          = password_hash($stateParameters->data['password'], PASSWORD_DEFAULT);
                    $stateParameters->data['password'] = $password;
                }
            }

            return $stateParameters;
        });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $fields = ['scan_melli', 'scan_govahiname', 'ax'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                    if (! file_exists(base_url('uploads/drivers/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('uploads/drivers/' . $stateParameters->primaryKeyValue, $file->getName());
                            $stateParameters->data[$field] = $file->getName();
                        }
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }

    public function RD()
    {
        $uri      = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);

        if ($segment3 == 'ax' || $segment3 == 'scan_melli') {

            $db      = \Config\Database::connect();
            $builder = $db->table('driver');
            $builder->where('did', $segment4);
            $query = $builder->get();

            if ($query->getNumRows() > 0) {

                $file = 'uploads/drivers/' . $segment3 . '/' . $query->getResultArray()[0][$segment3];

                if ($segment3 == 'ax') {
                    $builder->set('ax', '');
                    $builder->where('did', $segment4);
                    $builder->update();
                    if (is_file($file)) {
                        unlink($file);
                    }
                } elseif ($segment3 == 'scan_melli') {
                    $builder->set('scan_melli', '');
                    $builder->where('did', $segment4);
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

    public function OneStep()
    {

        $driver = [
            'gender'                       => $this->request->getPost('gender'),
            'name'                         => $this->request->getPost('first_name'),
            'lname'                        => $this->request->getPost('last_name'),
            'birthday'                     => $this->request->getPost('birthday'),
            'mobile'                       => $this->request->getPost('mobile'),
            'mobile2'                      => $this->request->getPost('mobile_2'),
            'phone'                        => $this->request->getPost('phone'),
            'address'                      => $this->request->getPost('address'),
            'melli'                        => $this->request->getPost('national_id'),
            'bank'                         => $this->request->getPost('bank_card_number'),
            'shaba'                        => $this->request->getPost('iban'),
            'note'                         => $this->request->getPost('notes'),
            'education_level'              => $this->request->getPost('education_level'),              /////////////////////////////////////
            'foreign_language'             => $this->request->getPost('foreign_language'),             ////////////////////////////////////
            'foreign_language_proficiency' => $this->request->getPost('foreign_language_proficiency'), ////////////////////////////////////
            'postal_code'                  => $this->request->getPost('postal_code'),
            'password'                     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $Driver = new DriverModel();

        // Query the database to check if a user with the mobile number exists
        $user = $Driver->where('mobile', $this->request->getPost('mobile'))->first();

        // Check if the user exists
        if ($user) {
            echo "<script>alert('چنین کاربری با این شماره تلفن از قبل وجود دارد ')</script>";
            return redirect()->to('add-driver');
        }

        if ($Driver->insert($driver)) {

            //-------------------------------------------------------------//

            $DID = $Driver->getInsertID();

            require_once APPPATH . 'Libraries/jdf.php';
            $currentDate = jdate('Ymd');
            $uniqueId    = $currentDate . '-' . (1000 + $DID);

            $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $uniqueId       = str_replace($persianNumbers, $englishNumbers, $uniqueId);

            $driver = [
                'ax'              => $this->upload_file('ax', "drivers", $DID),
                'scan_melli'      => $this->upload_file('scan_melli', "drivers", $DID),
                'scan_govahiname' => $this->upload_file('scan_govahiname', "drivers", $DID),
                'hash'            => md5($DID . $this->request->getPost('password') . date('Y-m-d H:i:s')),
                'code'            => $uniqueId,
            ];

            // print_r($driver);
            // die();

            $Driver->update($DID, $driver);

            //-------------------------------------------------------------//

            $car = [
                'driver_id'               => $DID,
                'year'                    => $this->request->getPost('year'),
                'car_system'              => $this->request->getPost('car_system'),
                'color'                   => $this->request->getPost('color'),
                'brand'                   => $this->request->getPost('brand'),

                'type'                    => $this->request->getPost('type'),                  ////////////////////////////////////
                'type_class'              => $this->request->getPost('type_class'),            ////////////////////////////////////
                'insurance_expiry_date'   => $this->request->getPost('insurance_expiry_date'), ////////////////////////////////////
                'owner'                   => $this->request->getPost('owner'),                 ////////////////////////////////////

                'iran'                    => $this->request->getPost('plate_part1'),
                'pelak'                   => $this->request->getPost('plate_part2'),
                'pelak_last'              => $this->request->getPost('plate_part3'),
                'harf'                    => $this->request->getPost('plate_letter'),

                'fuel'                    => $this->request->getPost('fuel_type'),
                'type'                    => $this->request->getPost('car_type'),
                'vin'                     => $this->request->getPost('vin'),

                'pic_back'                => $this->upload_file('pic_back', "drivers", $DID),
                'pic_front'               => $this->upload_file('pic_front', "drivers", $DID),
                'pic_in_back'             => $this->upload_file('pic_in_back', "drivers", $DID),
                'pic_in_front'            => $this->upload_file('pic_in_front', "drivers", $DID),

                'scan_car_card'           => $this->upload_file('scan_car_card', "drivers", $DID),
                'scan_car_card_back'      => $this->upload_file('scan_car_card_back', "drivers", $DID),
                'scan_insurance'          => $this->upload_file('scan_insurance', "drivers", $DID),
                'scan_insurance_addendum' => $this->upload_file('scan_insurance_Addendum', "drivers", $DID),
            ];

            $Car = new CarModel();
            $Car->insert($car);

            // Redirect to a success page
            return redirect()->to('all-drivers');
        }
    }

    private function upload_file($field_name, $type, $DID)
    {
        $file = $this->request->getFile($field_name);

        if (! empty($file)) {

            $config = [
                'uploadPath'   => './uploads/' . $type . "/" . $DID,
                'allowedTypes' => 'jpg|jpeg|png',
                'maxSize'      => 10240,
            ];


            if ($file->isValid()) {
                if ($file->move($config['uploadPath'])) {

                    $image = \Config\Services::image()
                        ->withFile($config['uploadPath'] . '/' . $file->getName())
                        ->resize(800, 600, true, 'auto') // تغییر اندازه به 800x600 با حفظ نسبت
                        ->save($config['uploadPath'] . '/' . $file->getName());

                    return $file->getName();
                } else {
                    $error = ['error' => 'Failed to upload file'];
                    return $error;
                }
            }
        }
    }

    public function updateCode()
    {
        $Driver  = new DriverModel();
        $drivers = $Driver->findAll();

        foreach ($drivers as $driver) {
            $current_date       = $driver['date_created'];
            $date               = new PersianDate();
            list($gy, $gm, $gd) = explode('-', substr($current_date, 0, 10));
            $persian_date       = $date->gregorianToJalali($gy, $gm, $gd, '');
            $persian_date       = $persian_date[0] . $persian_date[1] . $persian_date[2];

            $driver_code = $persian_date . '-' . (1000 + $driver['did']);

            $Driver->update($driver['did'], ['code' => $driver_code]);
        }

        return redirect()->back()->with('success', 'Driver codes updated successfully.');
    }

    public function GetDriverCars()
    {
        $driverId = $this->request->getPost('driverID');
        $Driver   = new CarModel();
        $data     = $Driver->GetDriverCars($driverId);

        if (empty($data)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No cars found for this driver.']);
        } else {
            return $this->response->setJSON(['status' => 'OK', 'data' => $data]);
        }
    }

    public function getAllDrivers()
    {
        $Driver  = new DriverModel();
        $drivers = $Driver->findAll();

        return $this->response->setJSON($drivers);
    }
}
