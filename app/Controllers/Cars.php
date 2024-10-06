<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use CodeIgniter\HTTP\URI;

class Cars extends BaseController
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
        $data = ['title' => 'Welcome to My Page'];

        echo view('parts/header');
        echo view('parts/side');
        echo view('table', $data);
        echo view('parts/footer');
    }


    public function Brands()
    {

        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('brand');
        $crud->setSubject('برند');
        $crud->unsetRead();
        // $crud->requiredFields(['city']);
        $crud->columns(['TiD', 'brand']);
        $crud->displayAs('TiD', "شناسه");
        $crud->displayAs('brand', "برند");


        $output = $crud->render();


        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');

    }


    public function Cars()
{
    $crud = new GroceryCrud();

    $crud->setLanguage("Persian");
    $crud->setTheme('bootstrap');
    $crud->setTable('cars');
    $crud->setSubject('خودرو', 'خودروها');
    // $crud->setRead();
    $crud->columns(['brand','cid', 'driver_id', 'fuel', 'harf', 'motor', 'pelak', 'pic_front','scan_car_id', 'shasi', 'type', 'vin']);
    $crud->fields(['brand','driver_id',  'fuel', 'harf', 'motor', 'pelak', 'pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_id', 'shasi', 'type', 'vin']);
    $crud->readFields(['brand', 'driver_id', 'fuel', 'harf', 'motor', 'pelak', 'pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_id', 'shasi', 'type', 'vin']);
    $crud->displayAs('cid', "شناسه خودرو");
    $crud->displayAs('driver_id', " راننده");
    $crud->displayAs('fuel', "نوع سوخت");
    $crud->displayAs('harf', "حرف");
    $crud->displayAs('motor', "موتور");
    $crud->displayAs('pelak', "پلاک");
    $crud->displayAs('pic_back', "تصویر پشت خودرو");
    $crud->displayAs('pic_front', "تصویر جلو خودرو");
    $crud->displayAs('pic_in_back', "تصویر داخلی پشت خودرو");
    $crud->displayAs('pic_in_front', "تصویر داخلی جلو خودرو");
    $crud->displayAs('scan_car_id', "اسکن کارت خودرو");
    $crud->displayAs('shasi', "شاسی");
    $crud->displayAs('type', "نوع خودرو");
    $crud->displayAs('vin', "وین");
    $crud->displayAs('brand', "برند");

    $crud->fieldType("fuel", "dropdown", ["1" => "بنزینی", "2" => "گازسوز", "3" => "گازوئیل", "4" => "دوگانه سوز", "5" => "هیبریدی"]);
    $crud->fieldType("type", "dropdown", ["1" => "سواری", "2" => "اتوبوس", "3" => "میدل باس", "4" => "مینی بوس", "5" => "ون"]);

    $crud -> setRelation('driver_id','driver','{name} {lname}');
    $crud -> setRelation('brand','brand','brand');


    $this->UploadCallback($crud, 'pic_back');
    $this->UploadCallback($crud, 'pic_front');
    $this->UploadCallback($crud, 'pic_in_back');
    $this->UploadCallback($crud, 'pic_in_front');
    $this->UploadCallback($crud, 'scan_car_id');

    $output = $crud->render();

    echo view('parts/header');
    echo view('parts/side');
    echo view('crud', (array) $output);
    echo view('parts/footer_crud');
}

    function UploadCallback($crud, $field) {


        $crud->callbackColumn($field, function ($row) use ($field) {
            return '<img src="' . base_url(relativePath: 'uploads/cars/'.$field.'/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackAddField($field, function () use ($field) {
            return ' <input name="' . $field . '" id="file-upload" type="file"> <div id="drop_zone"></div>
            <div id="progress"></div> ';
        });


        $crud->callbackEditField($field, function ($row , $pid) use ($field) {
            if(!empty($row)){
                return '<img src="' . base_url('uploads/cars/'.$field.'/' . $row) . '" width="500" height="500"> <a class="cls" href="'.base_url(relativePath: "RC/").$field.'/'.$pid.'" ><img src="'.base_url('assets/images/close.png').'" width="25" /> </a>';
            }else{
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';

            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters)  {

            $file = $this->request->getFile('pic_back');
            if(isset($file)){
            if (!file_exists(base_url('uploads/cars/pic_back/' . $file->getName()))) {
                if ($file->isValid()) {
                    $file->move('uploads/cars/pic_back', $file->getName());
                    $stateParameters->data['pic_back'] = $file->getName();
                }
            }
        }

            $scan = $this->request->getfile('pic_front');
            if(isset($scan)){
            if (!file_exists(base_url('uploads/cars/pic_front/' . $scan->getName()))) {
                if ($scan->isValid()) {
                    $scan->move('uploads/cars/pic_front', $scan->getName());
                    $stateParameters->data['pic_front'] = $scan->getName();
                }
            }
        }


        $scan = $this->request->getfile('pic_in_back');
        if(isset($scan)){
        if (!file_exists(base_url('uploads/cars/pic_in_back/' . $scan->getName()))) {
            if ($scan->isValid()) {
                $scan->move('uploads/cars/pic_in_back', $scan->getName());
                $stateParameters->data['pic_in_back'] = $scan->getName();
            }
        }
    }

    $scan = $this->request->getfile('pic_in_front');
    if(isset($scan)){
    if (!file_exists(base_url('uploads/cars/pic_in_front/' . $scan->getName()))) {
        if ($scan->isValid()) {
            $scan->move('uploads/cars/pic_in_front', $scan->getName());
            $stateParameters->data['pic_in_front'] = $scan->getName();
        }
    }
}

$scan = $this->request->getfile('scan_car_id');
if(isset($scan)){
if (!file_exists(base_url('uploads/cars/scan_car_id/' . $scan->getName()))) {
    if ($scan->isValid()) {
        $scan->move('uploads/cars/scan_car_id', $scan->getName());
        $stateParameters->data['scan_car_id'] = $scan->getName();
    }
}
}

            return $stateParameters;
        });



        // $crud->callbackBeforeUpdate(function ($stateParameters) use ($field) {

        //     $file = $this->request->getFile($field);
        //     if(isset($file)){
        //     if (!file_exists(base_url('uploads/cars/' . $field . '/' . $file->getName()))) {
        //         if ($file->isValid()) {
        //             $file->move('uploads/cars/' . $field . '/', $file->getName());
        //             $stateParameters->data[$field] = $file->getName();
        //         }
        //     }
        // }
        //     return $stateParameters;
        // });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $file = $this->request->getFile('ax');
            if(isset($file)){
            if (!file_exists(base_url('uploads/cars/ax/' . $file->getName()))) {
                if ($file->isValid()) {
                    $file->move('uploads/cars/ax', $file->getName());
                    $stateParameters->data['ax'] = $file->getName();
                }
            }
        }

            $scan = $this->request->getfile('scan_melli');
            if(isset($scan)){
            if (!file_exists(base_url('uploads/cars/scan_melli/' . $scan->getName()))) {
                if ($scan->isValid()) {
                    $scan->move('uploads/cars/scan_melli', $scan->getName());
                    $stateParameters->data['scan_melli'] = $scan->getName();
                }
            }
        }

            return $stateParameters;
        });

        return $crud;
    }



    public function RC() {
        $uri = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);
    
        $fields = ['pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_id'];


    
        if (in_array($segment3, $fields)) {
    
            $db = \Config\Database::connect();
            $builder = $db->table('cars');
            $builder->where('cid', $segment4);
            $query = $builder->get();
    
    
            if ($query->getNumRows() > 0) {
    
                $file = 'uploads/cars/' . $segment3 . '/' . $query->getResultArray()[0][$segment3];
    
                $builder->set($segment3, '');
                $builder->where('cid', $segment4);
                $builder->update();
                unlink($file);
                return redirect()->back()->with('success', 'Field updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Car not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid field type.');
        }
    }




}
