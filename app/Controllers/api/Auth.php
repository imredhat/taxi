<?php

namespace App\Controllers\API;
use CodeIgniter\RESTful\ResourceController;

use App\Models\DriverModel;
use App\Models\CarModel;


class Auth extends ResourceController
{
    protected $DriverModel;
    protected $session;


    public function start(){
        $tel = $this->request->getPost('tel');

        // Convert Persian numbers to English
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $tel = str_replace($persianNumbers, $englishNumbers, $tel);

        // Validate phone number format
        if (!preg_match('/^09[0-9]{9}$/', $tel)) {
            return $this->respond(['status' => 'error', 'message' => 'شماره تلفن نامعتبر است'], 400);
        }

        $client = new \Pishran\IpPanel\Client('QDGci7cuayxnUK0O9pjrtQ49XLLBc6q3OceICtwt8G4=');

        $patternCode = 'lxbuoa1vy0'; // شناسه الگو
        $originator = '+985000125475'; // شماره فرستنده
        $recipient = $tel; // شماره گیرنده

        $code = rand(10000, 99999);
        $values = ['code' => $code];
        
        // $bulkId = $client->sendPattern($patternCode, $originator, $recipient, $values);


        try {
            $result = $client->sendPattern($patternCode, $originator, $recipient, $values);
            if ($result) {
                return $this->respond(['status' => 'success', 'message' => 'کد تایید ارسال شد' , 'code' => $code]);
            } else {
                return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد'], 500);
            }
        } catch (Exception $e) {
            return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد: ' . $e->getMessage()], 500);
        }

    }

    public function login()
    {

        $mobile = $this->request->getPost('mobile');
        $password = $this->request->getPost('password');

        $Driver = new DriverModel();
        $user = $Driver->where('mobile', $mobile)->first();

        // print_r($user);die();

        if ($user && password_verify($password, $user['password'])) {

            $data = [
                'id' => $user['did'],
                'name' => $user['name'],
                'lname' => $user['lname'],
                'mobile' => $user['mobile'],
                'ax' => $user['ax'],
                'date_created' => $user['date_created'],
                'hash' => md5($user['did'].$user['password'].$user['date_created']),
            ];

            session()->set([
                'user_id' => $user['did'],
                'name' => $user['name'].' '.$user['lname'],
                'isLoggedIn' => true,
                'hash' => md5($user['did'].$user['password'].$user['date_created']),
            ]);

            $Driver-> update($user['did'], ['hash' => $data['hash']]);

            return $this->respond(['status' => 'success', 'message' => 'ورود با موفقیت انجام شد' , 'userdata' => $data]);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'نام کاربری یا رمز عبور اشتباه است'], 401);
        }
    }

    public function createUser()
    {
        // Load the form validation library
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required|valid_date',
            'mobile' => 'required|regex_match[/^09[0-9]{9}$/]',
            'national_id' => 'required|numeric',
            'bank_card_number' => 'required|numeric',
            'iban' => 'required',
            'password' => 'required|min_length[8]',
        ]);

        // Run validation
        if (!$validation->withRequest($this->request)->run()) {
            return $this->respond(['status' => 'error', 'message' => $validation->getErrors()], 400);
        }

        // Validation successful, insert data into database
        $data = [
            'gender'                => $this->request->getPost('gender'),
            'name'                  => $this->request->getPost('first_name'),
            'lname'                 => $this->request->getPost('last_name'),
            'birthday'              => $this->request->getPost('birthday'),
            'mobile'                => $this->request->getPost('mobile'),
            'mobile2'               => $this->request->getPost('mobile_2'),
            'phone'                 => $this->request->getPost('phone'),
            'address'               => $this->request->getPost('address'),
            'melli'                 => $this->request->getPost('national_id'),
            'cooperation_type'      => $this->request->getPost('cooperation_type'),
            'bank_card_number'      => $this->request->getPost('bank_card_number'),
            'shaba'                 => $this->request->getPost('iban'),
            'ax'                    => $this->upload_file('ax', "drivers"),
            'scan_melli'            => $this->upload_file('scan_melli', "drivers"),
            'scan_govahiname'       => $this->upload_file('scan_govahiname', "drivers"),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // print_r($driver);
        // die();

        $Driver = new DriverModel();

        if ($Driver->insert($data)) {
            $DID = $Driver->getInsertID();



            $car = array(
                'driver_id'        => $DID,
                'year'             => $this->request->getPost('year'),
                'car_system'       => $this->request->getPost('car_system'),
                'color'            => $this->request->getPost('color'),
                'brand'            => $this->request->getPost('brand'),

                'iran'             => $this->request->getPost('plate_part1'),
                'pelak'            => $this->request->getPost('plate_part2'),
                'pelak_last'       => $this->request->getPost('plate_part3'),
                'harf'             => $this->request->getPost('plate_letter'),

                'fuel'             => $this->request->getPost('fuel_type'),
                'type'             => $this->request->getPost('car_type'),
                'vin'              => $this->request->getPost('vin'),

                'scan_govahiname'  => $this->upload_file('scan_govahiname', "drivers"),
                'pic_back'         => $this->upload_file('pic_back', "cars"),
                'pic_front'        => $this->upload_file('pic_front', "cars"),
                'pic_in_back'      => $this->upload_file('pic_in_back', "cars"),
                'pic_in_front'     => $this->upload_file('pic_in_front', "cars"),
            );

            $Car = new CarModel();
            $Car->insert($car);

            // print_r($data['password']);
            // die();
            
            $hash = md5($DID.$data['password'].date('Y-m-d H:i:s'));
            return $this->respond(['status' => 'success', 'message' => 'راننده با موفقیت ثبت شد', 'DriverID' => $DID, 'Hash' => $hash]);
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








    public function forgotPassword()
    {
        $email = $this->request->getPost('email');
        $user = $this->DriverModel->where('email', $email)->first();

        if ($user) {
            // Generate a reset token and send email logic here
            // For simplicity, we are just returning a success message
            return redirect()->to('/auth/login')->with('success', 'Password reset link sent to your email');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth')->with('success', 'Logged out successfully');
    }
}