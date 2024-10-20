<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FareModel;


class Option extends BaseController
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

        $model = new FareModel();
        $data['options'] = $model->findAll();

        // echo "<pre>";
        // print_r($data);
        // die();

        echo view('parts/header');
        echo view('parts/side');
        echo view('admin/fare_option', $data);
        echo view('parts/footer');
    }


    public function update($id)
    {
        $model = new FareModel();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'option' => $this->request->getPost('option'),
                'name' => $this->request->getPost('name'),
                'values' => json_encode($this->request->getPost('values')),
                'rate' => json_encode($this->request->getPost('rate'))
            ];

            $model->update($id, $data);
            return redirect()->to('/options')->with('message', 'آپشن با موفقیت به‌روزرسانی شد');
        }

        $data['option'] = $model->find($id);
        return view('options/edit', $data);
    }



    public function Packages()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('packages');
        $crud->setSubject('پکیج', 'پکیج ها');
        $crud->unsetDelete();
        // $crud->unsetRead();
        $crud->columns(['id', 'name', 'base_fare', 'long_fare', 'distance_rate', 'wait_rate']);
        $crud->fields(['name', 'base_fare', 'long_fare', 'distance_rate', 'wait_rate']);
        $crud->displayAs('id', "شناسه");
        $crud->displayAs('name', "نام");
        $crud->displayAs('base_fare', "کرایه ورودی زیر 50 کیلومتر");
        $crud->displayAs('long_fare', "کرایه  ورودی بیشتر از 50 کیلومتر");

        $crud->displayAs('distance_rate', "مبلغ به ازای هر کیلومتر");
        $crud->displayAs('wait_rate', "هزینه هر ساعت توقف");

        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }

    public function saveSettings()
    {
        $model = new FareModel();

        $isHoliday          = $this->request->getPost('isHoliday');
        $extraPassenger     = $this->request->getPost('extraPassenger');
        $bad_road           = $this->request->getPost('bad_road');


        $data1 = ["rate" => $isHoliday];
        $model->where("option", "isHoliday")->set($data1)->update();

        $data2 = ["rate" => $extraPassenger];
        $model->where("option", "extraPassenger")->set($data2)->update();

        $data3 = ["rate" => $bad_road];
        $model->where("option", "bad_road")->set($data3)->update();

        echo "<script>alert('تنظیمات ذخیره شد') </script>";

        return redirect()->to('Option/Other');
    }
}
