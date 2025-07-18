<?php
namespace App\Controllers\API;

use App\Models\CarModel;
use App\Models\DriverModel;
use App\Models\TripsModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $DriverModel;
    protected $session;

    public function checIn()
    {
        $tel = $this->request->getPost('tel');

        // Convert Persian numbers to English
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $tel            = str_replace($persianNumbers, $englishNumbers, $tel);

        // Validate phone number format
        if (! preg_match('/^09[0-9]{9}$/', $tel)) {
            return $this->respond(['status' => 'error', 'message' => 'شماره تلفن نامعتبر است'], 400);
        }


        $Driver = new DriverModel();
        $user = $Driver->where('mobile', $tel)->first();

        if ($user) {
            return $this->respond(['status' => 'exist', 'message' => 'این شماره تلفن قبلا ثبت شده است'], 200);
        }


        $client = new \Pishran\IpPanel\Client('SA11ECEv6ZmVGJbalKfGGhGcLKjXNA00fxoN5DMoFPs=');

        $patternCode = 's108sjij14ar631'; // شناسه الگو
        $originator  = '+983000505';      // شماره فرستنده
        $recipient   = $tel;              // شماره گیرنده

        $code   = rand(1000, 9999);
        $values = ['code' => $code];

        // $bulkId = $client->sendPattern($patternCode, $originator, $recipient, $values);

        try {
            $result = $client->sendPattern($patternCode, $originator, $recipient, $values);
            if ($result) {
                return $this->respond(['status' => 'success', 'message' => 'کد تایید ارسال شد', 'code' => $code]);
            } else {
                return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد'], 500);
            }
        } catch (Exception $e) {
            return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد: ' . $e->getMessage()], 500);
        }
    }

    public function login()
    {

        $mobile   = $this->request->getPost('mobile');
        $password = $this->request->getPost('password');

        $Driver = new DriverModel();
        $user   = $Driver->where('mobile', $mobile)->first();
        $data   = [];

        // print_r($user);die();

        if($user['status'] == 'غیرفعال'){
            return $this->respond(['status' => 'not-active', 'message' => 'حساب کاربری شما هنوز تایید نشده یا غیرفعال است'], 401);
        }

        if ($user && password_verify($password, $user['password'])) {
            $data = [
                'id'           => $user['did'],
                'code'         => $user['code'],
                'name'         => $user['name'],
                'lname'        => $user['lname'],
                'mobile'       => $user['mobile'],
                'ax'           => $user['ax'],
                'date_created' => $user['date_created'],
                'hash'         => $user['hash'],
            ];

            
            $tripModel = new TripsModel();
            $trips = $tripModel->getMyRequest($user['did'],null,null,"Done");

            $totalTrips = count($trips);
            $totalFare = array_sum(array_column($trips, 'driverCustomFare'));

            $data['total_trips'] = $totalTrips;
            $data['total_fare'] = $totalFare;

            

            session()->set([
                'user_id'    => $user['did'],
                'name'       => $user['name'] . ' ' . $user['lname'],
                'isLoggedIn' => true,
                'hash'         => $user['hash'],
            ]);

            $Driver->update($user['did'], ['hash' => $data['hash']]);

            return $this->respond(['status' => 'success', 'message' => 'ورود با موفقیت انجام شد', 'userdata' => $data]);
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
            'gender'           => 'required',
            'first_name'       => 'required',
            'last_name'        => 'required',
            'mobile'           => 'required|regex_match[/^09[0-9]{9}$/]',
            'national_id'      => 'required|numeric',
            'bank_card_number' => 'required|numeric',
            'iban'             => 'required',
            'password'         => 'required|min_length[8]',
        ]);

        // Run validation
        if (! $validation->withRequest($this->request)->run()) {
            return $this->respond(['status' => 'error', 'message' => $validation->getErrors()], 400);
        }

        // Initialize the DriverModel
        $Driver = new DriverModel();
        // Query the database to check if a user with the mobile number exists
        $user = $Driver->where('mobile', $this->request->getPost('mobile'))->first();

        // Check if the user exists
        if ($user) {
            return $this->respond(['status' => 'success', 'message' => 'User  exists']);
        }

        $name = $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name');
        $tel = $this->request->getPost('mobile');

        $data = [
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
            'card_holder_name'             => $this->request->getPost('card_holder_name'),
            'note'                         => $this->request->getPost('notes'),
            'education_level'              => $this->request->getPost('education_level'),  /////////////////////////////////////
            'foreign_language'             => $this->request->getPost('foreign_language'), ////////////////////////////////////
            'foreign_language_proficiency' => $this->request->getPost('foreign_language_proficiency'),
            'postal_code'                  => $this->request->getPost('postal_code'),
            'password'                     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status'                       => 'غیرفعال',

        ];

        $Driver = new DriverModel();

        if ($Driver->insert($data)) {

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
                'harf'                    => $this->request->getPost('plate_letter'),
                'pelak_last'              => $this->request->getPost('plate_part3'),

                'fuel'                    => $this->request->getPost('fuel_type'),
                'vin'                     => $this->request->getPost('vin'),

                'pic_back'                => $this->upload_file('pic_back', "drivers", $DID),
                'pic_front'               => $this->upload_file('pic_front', "drivers", $DID),
                'pic_in_back'             => $this->upload_file('pic_in_back', "drivers", $DID),
                'pic_in_front'            => $this->upload_file('pic_in_front', "drivers", $DID),

                'scan_car_card'           => $this->upload_file('scan_car_card', "drivers", $DID),
                'scan_car_card_back'      => $this->upload_file('scan_car_card_back', "drivers", $DID),
                'scan_insurance'          => $this->upload_file('scan_insurance', "drivers", $DID),
                'scan_insurance_addendum' => $this->upload_file('scan_insurance_addendum', "drivers", $DID),
            ];

            $Car = new CarModel();
            $Car->insert($car);

            $client = new \Pishran\IpPanel\Client('SA11ECEv6ZmVGJbalKfGGhGcLKjXNA00fxoN5DMoFPs=');

            $patternCode = '1zl24i03wr9vu3a'; // شناسه الگو
            $originator  = '+983000505';      // شماره فرستنده
            $recipient   = $tel;              // شماره گیرنده

            $values = ['name' => $name ,'ref' => $uniqueId];

            $bulkId = $client->sendPattern($patternCode, $originator, $recipient, $values);

            $hash = md5($DID . $data['password'] . date('Y-m-d H:i:s'));
            return $this->respond(['status' => 'success', 'message' => 'راننده با موفقیت ثبت شد', 'DriverID' => $uniqueId, 'Hash' => $hash]);


        }
    }

    private function upload_file($field_name, $type, $DID)
    {
        $file = $this->request->getFile($field_name);
        if (! empty($file)) {
            $config = [
                'uploadPath'   => './uploads/' . $type . "/" . $DID,
                'allowedTypes' => 'jpg|jpeg|png',
                'maxSize'      => 1024,
            ];

            


            if ($file->isValid()) {
                if ( $file->move($config['uploadPath'])) {

                    $image = \Config\Services::image()
                        ->withFile($config['uploadPath'].'/'.$file->getName())
                        // ->resize(800, 600, true, 'auto') // تغییر اندازه به 800x600 با حفظ نسبت
                        ->save($config['uploadPath'].'/'.$file->getName());

                    return $file->getName();


                }else{
                    $error = ['error' => 'Failed to upload file'];
                    return $error;
                }

                
            }
        }
    }

    public function forget()
    {
        $tel = $this->request->getPost('mobile');

        // Convert Persian numbers to English
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $tel            = str_replace($persianNumbers, $englishNumbers, $tel);

        // Validate phone number format
        if (! preg_match('/^09[0-9]{9}$/', $tel)) {
            return $this->respond(['status' => 'error', 'message' => 'شماره تلفن نامعتبر است'], 400);
        }


        $Driver = new DriverModel();
        $user = $Driver->where('mobile', $tel)->first();

        // print_r($user);die();

        if (!$user) {
            return $this->respond(['status' => 'error', 'message' => 'کاربری با این شماره تلفن یافت نشد'], 404);
        }
        

        $client = new \Pishran\IpPanel\Client('SA11ECEv6ZmVGJbalKfGGhGcLKjXNA00fxoN5DMoFPs=');

        $patternCode = 's108sjij14ar631'; // شناسه الگو
        $originator  = '+983000505';      // شماره فرستنده
        $recipient   = $tel;              // شماره گیرنده

        $code   = rand(1000, 9999);
        $values = ['code' => $code];

        // $bulkId = $client->sendPattern($patternCode, $originator, $recipient, $values);

        try {
            $result = $client->sendPattern($patternCode, $originator, $recipient, $values);
            if ($result) {
                return $this->respond(['status' => 'success', 'message' => 'کد تایید ارسال شد', 'code' => $code]);
            } else {
                return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد'], 500);
            }
        } catch (Exception $e) {
            return $this->respond(['status' => 'error', 'message' => 'ارسال پیامک با خطا مواجه شد: ' . $e->getMessage()], 500);
        }
    }

    public function updatePasswd()
    {
        $phone = $this->request->getPost('mobile');
        $newPassword = $this->request->getPost('new_password');

        $Driver = new DriverModel();
        $user = $Driver->where('mobile', $phone)->first();

        if ($user) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $Driver->update($user['did'], ['password' => $hashedPassword]);
            return $this->respond(['status' => 'success', 'message' => 'رمز عبور با موفقیت به روز شد']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'کاربری با این شماره تلفن یافت نشد'], 404);
        }
    }

    public function app(){
        $appModel = new \App\Models\AppModel();
        $appData = $appModel->orderBy('id', 'DESC')->first();
        unset($appData['id']);

        return $this->respond(['status' => 'success', 'data' => $appData]);
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth')->with('success', 'Logged out successfully');
    }
}
