<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use CodeIgniter\HTTP\URI;
use App\Models\TypeModel;
use App\Models\CarModel;

class Cars extends BaseController
{

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
        $crud->fields(['brand']);
        $crud->displayAs('TiD', "شناسه");
        $crud->displayAs('brand', "برند");


        $output = $crud->render();


        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }


    public function Type()
    {

        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('brand_type');
        $crud->setSubject('تیپ خودرو');
        $crud->unsetRead();
        // $crud->requiredFields(['city']);
        $crud->columns(['bid','type_brand', 'type_name' , 'type_class']);
        $crud->fields(['type_brand','type_name' , 'type_class']);
        $crud->displayAs('bid', "شناسه");
        $crud->displayAs('type_brand', "برند");
        $crud->displayAs('type_class', "کلاس خودرو");
        $crud->displayAs('type_name', "تیپ");

        $crud->setRelation('type_class', 'packages', 'name');
        $crud->setRelation('type_brand', 'brand', 'brand');



        $output = $crud->render();


        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }


    public function GetBrandCars($Brand){

        $typeModel = new TypeModel();       
        $typeModel = $typeModel->where('type_brand' , $Brand)->withDeleted()->findAll();

        return $this->response->setJSON($typeModel);
    }

    /*---------------------------------------------------------\
      |                   List Drivers
      |---------------------------------------------------------/
     */

    public function Cars()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('cars');
        $crud->setSubject('خودرو', 'خودروها');

        // $crud->setRead();
        $crud->columns(['cid','brand', 'type', 'driver_id', 'fuel', 'pelak_mix', 'pic_front',   'type', 'type_class']);
        $crud->fields([
            'owner','driver_id', 'brand','type', 'type_class', 'fuel', 'iran', 'pelak', 'harf', 'pelak_last',  
            'pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_card', 
            'scan_car_card_back', 'scan_insurance', 'scan_insurance_addendum', 
             'vin',  'year', 'color', 'insurance_expiry_date'
        ]);
        $crud->displayAs('cid', "شناسه ");
        $crud->displayAs('driver_id', " راننده");
        $crud->displayAs('fuel', "نوع سوخت");
        $crud->displayAs('harf', "حرف");
        $crud->displayAs('motor', "موتور");
        $crud->displayAs('pelak', "سه رقم پلاک");
        $crud->displayAs('pelak_mix', "پلاک خودرو");
        $crud->displayAs('pic_back', "تصویر پشت خودرو");
        $crud->displayAs('pic_front', "تصویر جلو خودرو");
        $crud->displayAs('pic_in_back', "تصویر داخلی پشت خودرو");
        $crud->displayAs('pic_in_front', "تصویر داخلی جلو خودرو");
        $crud->displayAs('scan_car_card', "اسکن کارت خودرو");
        $crud->displayAs('scan_car_card_back', "اسکن پشت کارت خودرو");
        $crud->displayAs('scan_insurance', "اسکن بیمه");
        $crud->displayAs('scan_insurance_addendum', "اسکن الحاقیه بیمه");
        $crud->displayAs('shasi', "شاسی");
        $crud->displayAs('type', "نوع خودرو");
        $crud->displayAs('vin', "وین");
        $crud->displayAs('brand', "برند");
        $crud->displayAs('owner', "مالک");
        $crud->displayAs('iran', "ایران");
        $crud->displayAs('pelak_last', "دو رقم آخر پلاک");
        $crud->displayAs('type_class', "کلاس خودرو");
        $crud->displayAs('car_system', "سیستم خودرو");
        $crud->displayAs('year', "سال");
        $crud->displayAs('color', "رنگ");
        $crud->displayAs('insurance_expiry_date', "تاریخ انقضای بیمه");

        $crud->unsetColumns(['pelak_last', 'harf', 'iran', 'pelak']);

        $crud->callbackColumn('pelak_mix', function ($value, $row) {
            return "ایران".$row->iran . '-' . $row->harf . ' ' . $row->pelak . ' ' . $row->pelak_last;
        });

        $crud->setRelation('type_class', 'packages', 'name');
        

        $crud->fieldType("fuel", "dropdown", [
            "بنزینی" => "بنزینی", 
            "گاز سوز" => "گاز سوز", 
            "گازوئیل" => "گازوئیل", 
            "دوگانه سوز" => "دوگانه سوز", 
            "هیبریدی" => "هیبریدی"
        ]);
        $crud->setRelation('type', 'brand_type', 'type_name');
        $crud->setRelation('driver_id', 'driver', '{name} {lname}');
        $crud->setRelation('brand', 'brand', 'brand');
        $crud->setRelation('type_class', 'packages', 'name');
        $crud->fieldType("harf", "dropdown", [
            "الف" => "الف",
            "ب" => "ب",
            "پ" => "پ",
            "ت" => "ت",
            "ث" => "ث",
            "ج" => "ج",
            "د" => "د",
            "ز" => "ز",
            "س" => "س",
            "ش" => "ش",
            "ص" => "ص",
            "ط" => "ط",
            "ع" => "ع",
            "ف" => "ف",
            "ق" => "ق",
            "ک" => "ک",
            "گ" => "گ",
            "ل" => "ل",
            "م" => "م",
            "ن" => "ن",
            "و" => "و",
            "ه" => "ه",
            "ی" => "ی",
            "معلولین" => "معلولین",
            "تشریفات" => "تشریفات"
        ]);


        $this->UploadCallback($crud, 'pic_back');
        $this->UploadCallback($crud, 'pic_front');
        $this->UploadCallback($crud, 'pic_in_back');
        $this->UploadCallback($crud, 'pic_in_front');
        $this->UploadCallback($crud, 'scan_govahiname');
        $this->UploadCallback($crud, 'scan_car_card');
        $this->UploadCallback($crud, 'scan_car_card_back');
        $this->UploadCallback($crud, 'scan_insurance');
        $this->UploadCallback($crud, 'scan_insurance_addendum');

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }










    public function DriverCars($ID)
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('cars');
        $crud->setSubject('خودرو', 'خودروها');

        $crud->where('driver_id', $ID);

        $crud->columns(['brand', 'cid', 'driver_id', 'fuel', 'pelak_mix', 'pic_front',   'type', 'type_class']);
        $crud->fields([
            'owner','driver_id', 'brand','type', 'type_class', 'fuel', 'iran', 'pelak', 'harf', 'pelak_last',  
            'pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_card', 
            'scan_car_card_back', 'scan_insurance', 'scan_insurance_addendum', 
             'vin',  'year', 'color', 'insurance_expiry_date','active'
        ]);
        $crud->displayAs('cid', "شناسه ");
        $crud->displayAs('driver_id', " راننده");
        $crud->displayAs('fuel', "نوع سوخت");
        $crud->displayAs('harf', "حرف");
        $crud->displayAs('motor', "موتور");
        $crud->displayAs('pelak', "سه رقم پلاک");
        $crud->displayAs('pelak_mix', "پلاک خودرو");
        $crud->displayAs('pic_back', "تصویر پشت خودرو");
        $crud->displayAs('pic_front', "تصویر جلو خودرو");
        $crud->displayAs('pic_in_back', "تصویر داخلی پشت خودرو");
        $crud->displayAs('pic_in_front', "تصویر داخلی جلو خودرو");
        $crud->displayAs('scan_car_card', "اسکن کارت خودرو");
        $crud->displayAs('scan_car_card_back', "اسکن پشت کارت خودرو");
        $crud->displayAs('scan_insurance', "اسکن بیمه");
        $crud->displayAs('scan_insurance_addendum', "اسکن الحاقیه بیمه");
        $crud->displayAs('shasi', "شاسی");
        $crud->displayAs('type', "نوع خودرو");
        $crud->displayAs('vin', "وین");
        $crud->displayAs('brand', "برند");
        $crud->displayAs('owner', "مالک");
        $crud->displayAs('iran', "ایران");
        $crud->displayAs('pelak_last', "دو رقم آخر پلاک");
        $crud->displayAs('type_class', "کلاس خودرو");
        $crud->displayAs('car_system', "سیستم خودرو");
        $crud->displayAs('year', "سال");
        $crud->displayAs('color', "رنگ");
        $crud->displayAs('active', "وضعیت");
        $crud->displayAs('insurance_expiry_date', "تاریخ انقضای بیمه");

        $crud->unsetColumns(['pelak_last', 'harf', 'iran', 'pelak']);

        $crud->callbackColumn('pelak_mix', function ($value, $row) {
            return "ایران".$row->iran . '-' . $row->harf . ' ' . $row->pelak . ' ' . $row->pelak_last;
        });

        $crud->setRelation('type_class', 'packages', 'name');
        

        $crud->fieldType("fuel", "dropdown", [
            "بنزینی" => "بنزینی", 
            "گاز سوز" => "گاز سوز", 
            "گازوئیل" => "گازوئیل", 
            "دوگانه سوز" => "دوگانه سوز", 
            "هیبریدی" => "هیبریدی"
        ]);


        $crud->fieldType("active", "dropdown", [
            "1" => "فعال",
            "0" => "غیرفعال"
        ]);
        

        $crud->setRelation('type', 'brand_type', 'type_name');
        $crud->setRelation('driver_id', 'driver', '{name} {lname}');
        $crud->setRelation('brand', 'brand', 'brand');
        $crud->setRelation('type_class', 'packages', 'name');
        $crud->fieldType("harf", "dropdown", [
            "الف" => "الف",
            "ب" => "ب",
            "پ" => "پ",
            "ت" => "ت",
            "ث" => "ث",
            "ج" => "ج",
            "د" => "د",
            "ز" => "ز",
            "س" => "س",
            "ش" => "ش",
            "ص" => "ص",
            "ط" => "ط",
            "ع" => "ع",
            "ف" => "ف",
            "ق" => "ق",
            "ک" => "ک",
            "گ" => "گ",
            "ل" => "ل",
            "م" => "م",
            "ن" => "ن",
            "و" => "و",
            "ه" => "ه",
            "ی" => "ی",
            "معلولین" => "معلولین",
            "تشریفات" => "تشریفات"
        ]);


        $this->UploadCallback($crud, 'pic_back');
        $this->UploadCallback($crud, 'pic_front');
        $this->UploadCallback($crud, 'pic_in_back');
        $this->UploadCallback($crud, 'pic_in_front');
        $this->UploadCallback($crud, 'scan_govahiname');
        $this->UploadCallback($crud, 'scan_car_card');
        $this->UploadCallback($crud, 'scan_car_card_back');
        $this->UploadCallback($crud, 'scan_insurance');
        $this->UploadCallback($crud, 'scan_insurance_addendum');

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }









    function UploadCallback($crud, $field)
    {

        $crud->callbackColumn($field, function ($row , $data) use ($field) {
            return '<img src="' . base_url(relativePath: 'uploads/drivers/' . $data -> driver_id . '/' . $row) . '" width="100" height="200">';
        });


        $crud->callbackEditField($field, function ($row, $pid , $rowData) use ($field) {

            
            $CarModel = new CarModel();
            $car = $CarModel->where('cid', $pid)->first();
            $driver_id = $car['driver_id'];

            if (!empty($row)) {
                return '<img src="' . base_url('uploads/drivers/' . $driver_id . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RC/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_car_card', 'scan_car_card_back','scan_insurance', 'scan_insurance_addendum'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                if (!file_exists(base_url('uploads/drivers/' . $stateParameters->data['driver_id'] . '/' . $file->getName()))) {
                    if ($file->isValid()) {
                    $file->move('uploads/drivers/' . $stateParameters->data['driver_id'], $file->getName());
                    $stateParameters->data[$field] = $file->getName();
                    }
                }
                }
        }

            return $stateParameters;
        });
        

        $crud->callbackBeforeInsert(function ($stateParameters) {
            $fields = ['pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_govahiname'];
            foreach ($fields as $field) {
            $file = $this->request->getFile($field);
            if (isset($file)) {
                if (!file_exists('uploads/drivers/' . $stateParameters->data['driver_id'] . '/' . $file->getName())) {
                if ($file->isValid()) {
                    $file->move('uploads/drivers/' . $stateParameters->data['driver_id'], $file->getName());
                    $stateParameters->data[$field] = $file->getName();
                }
                }
            }
            }
            return $stateParameters;
        });

        return $crud;
    }



    public function RC()
    {
        $uri = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);


        $referer = $this->request->getServer('HTTP_REFERER');
        $referer = str_replace(base_url(), '', $referer);

        $fields = ['pic_back', 'pic_front', 'pic_in_back', 'pic_in_front', 'scan_govahiname','scan_insurance','scan_car_card','scan_car_card_back'];

        $CarModel = new CarModel();
        $car = $CarModel->where('cid', $segment4)->first();
        $driver_id = $car['driver_id'];



        if (in_array($segment3, $fields)) {

            $db = \Config\Database::connect();
            $builder = $db->table('cars');
            $builder->where('cid', $segment4);
            $query = $builder->get();


            if ($query->getNumRows() > 0) {

                $file = 'uploads/drivers/' . $driver_id . '/' . $query->getResultArray()[0][$segment3];

                $builder->set($segment3, '');
                $builder->where('cid', $segment4);
                $builder->update();
                if (is_file($file)) {
                    unlink($file);
                }
                return redirect()->to($referer)->with('success', 'Field updated successfully.');
            } else {
                return redirect()->to($referer)->with('error', 'Car not found.');
            }
        } else {
            return redirect()->to($referer)->with('error', 'Invalid field type.');
        }
    }


}
