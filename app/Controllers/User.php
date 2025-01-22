<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Libraries\PersianDate;
use App\Models\UserModel;

class User extends BaseController
{

    public function __construct()
    {
        if (!session()->has('user_id')) {
            header('location:/auth');
            exit();
        }
    }

    public function index()
    {
        echo view('parts/header');
        echo view('parts/side');
        echo view('Home');
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
        $crud->columns(['cid', 'name', 'address', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'website', 'industry', 'description']);
        $crud->fields(['name', 'address', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'website', 'industry', 'description']);
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
            'status',
            'date_start'
        ]);

        $crud->displayAs([
            'id' => 'شناسه',
            'name' => 'نام',
            'lname' => 'نام خانوادگی',
            'gender' => 'جنسیت',
            'mobile' => 'موبایل',
            'phone' => 'تلفن',
            'type' => 'نوع اشتراک',
            'status' => 'وضعیت',
            'ax' => 'تصویر شخص / شرکت',
            'created_at' => 'تاریخ ثبت',
            'updated_at' => 'تاریخ بروزرسانی',
            'deleted_at' => 'تاریخ حذف',
            'date_start' => 'شروع اشتراک',
        ]);

        $crud->fieldType('gender', 'dropdown', [
            '' => 'انتخاب جنسیت',
            'مرد' => 'مرد',
            'زن' => 'زن',
        ]);

        $crud->fieldType('type', 'dropdown', [
            '' => 'انتخاب جنسیت',
            'حقیقی' => 'حقیقی',
            'حقوقی' => 'حقوقی',
        ]);

        $crud->fieldType('status', 'dropdown', [
            '' => 'انتخاب وضعیت',
            'تایید شده' => 'تایید شده',
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

    function UploadCallback($crud, $field)
    {
        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            return '<img src="' . base_url('uploads/user/' . $data -> id . '/' . $row) . '" width="100" height="200">';
        });

        $crud->callbackEditField($field, function ($row, $pid) use ($field) {
            
            if (!empty($row)) {
                return '<img src="' . base_url('uploads/user/' . $pid . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RU/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });
        

        $crud->callbackBeforeUpdate(function ($stateParameters) {


            $fields = ['scan_melli', 'scan_govahiname','ax'];
            foreach ($fields as $field) {
            $file = $this->request->getFile($field);
            if (isset($file)) {
                if (!file_exists(base_url('uploads/user/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
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
                if (!file_exists(base_url('uploads/user/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/user/', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (!file_exists(base_url('uploads/user/' . $scan->getName()))) {
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
        $ID = $uri->getSegment(2);

        $User = new UserModel();
        $User = $User->where('id', $ID)->find()[0];
        $data['user'] = $User;

        echo view('parts/print/header');
        echo view('user_card', $data);
        echo view('parts/print/footer');
    }


    public function RD()
    {
        $uri = service('uri');
        $segment2 = $uri->getSegment(2);
        $segment3 = $uri->getSegment(3);

        
        if ($segment2 == 'ax') {

            $db = \Config\Database::connect();
            $builder = $db->table('user');
            $builder->where('id', $segment3);
            $query = $builder->get();


            if ($query->getNumRows() > 0) {

                $file = 'uploads/user/' . $segment3 . '/' . $query->getResultArray()[0][$segment2];

                if ($segment2 == 'ax') {
                    $builder->set('ax', '');
                    $builder->where('id', $segment3);
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
}
