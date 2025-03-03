<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FareModel;


class Option extends BaseController
{
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
        echo view('parts/footer_js');
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
        $crud->columns(['id', 'logo','name', 'base_fare', 'long_fare', 'distance_rate', 'wait_rate']);
        $crud->fields(['name',  'logo','base_fare', 'long_fare', 'distance_rate', 'wait_rate' , 'dsc']);
        $crud->displayAs('id', "شناسه");
        $crud->displayAs('name', "نام");
        $crud->displayAs('base_fare', "کرایه ورودی زیر 50 کیلومتر");
        $crud->displayAs('long_fare', "کرایه  ورودی بیشتر از 50 کیلومتر");

        $crud->displayAs('distance_rate', "مبلغ به ازای هر کیلومتر");
        $crud->displayAs('wait_rate', "هزینه هر ساعت توقف");
        $crud->displayAs('logo', "تصویر");
        $crud->displayAs('dsc', "توضیحات");
        
        $this->UploadCallback($crud, 'logo');


        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }



    public function banks()
    {
        $crud = new GroceryCrud();

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('bnks');
        $crud->setSubject('حساب بانکی', 'حساب های بانکی');
        $crud->unsetDelete();
        $crud->columns(['id', 'title', 'bank_name', 'holder_name', 'card_number', 'shaba', 'active']);
        $crud->fields(['title', 'bank_name', 'holder_name', 'card_number', 'shaba', 'active']);
        $crud->displayAs('id', "شناسه");
        $crud->displayAs('title', "عنوان");
        $crud->displayAs('bank_name', "نام بانک");
        $crud->displayAs('holder_name', "نام صاحب حساب");
        $crud->displayAs('card_number', "شماره کارت");
        $crud->displayAs('shaba', "شماره شبا");
        $crud->displayAs('active', "وضعیت");

        $crud->fieldType('active', 'dropdown', ['1' => 'فعال', '0' => 'غیرفعال']);

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



    public function UploadCallback($crud, $field)
    {
        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            return '<img src="' . base_url('assets/uploads/packages/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackEditField($field, function ($row, $pid) use ($field) {

            if (! empty($row)) {
                return '<img src="' . base_url('assets/uploads/packages/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RL/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackAddField($field, function () use ($field) {
            return '<input name="' . $field . '" id="file-upload" type="file">';
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['logo'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {

                    if (! file_exists(base_url('assets/uploads/packages/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('assets/uploads/packages/', $file->getName());
                            $stateParameters->data[$field] = $file->getName();

                            // print_r($stateParameters);
                            // die();
                        }
                    }
                }
            }


            return $stateParameters;
        });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $fields = ['logo'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                    if (! file_exists(base_url('assets/uploads/packages/'. $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('assets/uploads/packages/', $file->getName());
                            $stateParameters->data[$field] = $file->getName();
                        }
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }


    public function RL()
    {
        $uri      = service('uri');
        $segment3 = $uri->getSegment(2);
        $segment4 = $uri->getSegment(3);

        if ($segment3 == 'logo' || $segment3 == 'scan_melli') {

            $db      = \Config\Database::connect();
            $builder = $db->table('packages');
            $builder->where('id', $segment4);
            $query = $builder->get();

            if ($query->getNumRows() > 0) {

                $file = 'assets/uploads/packages/' . $query->getResultArray()[0][$segment3];

                if ($segment3 == 'logo') {
                    $builder->set('logo', '');
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
