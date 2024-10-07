<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;

class User extends BaseController
{


    public function checkLogin()
    {
        $session = service('session');
        if (!$session->has('user_id')) {
            return redirect()->to('auth');
        }
    }

    

    public function index()
    {
        $this -> checkLogin();

        
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


        $crud->requiredFields(['name']);
        $crud->columns([
            'id',
            'name',
            'lname',
            'gender',
            'mobile',
            'type',
            'status',
        ]);

        $crud->fields([
            'name',
            'lname',
            'gender',
            'mobile',
            'phone',
            'type',
            'status'
        ]);

        $crud->displayAs([
            'id' => 'شناسه',
            'name' => 'نام',
            'lname' => 'نام خانوادگی',
            'gender' => 'جنسیت',
            'mobile' => 'موبایل',
            'phone' => 'تلفن',
            'type' => 'نوع',
            'status' => 'وضعیت',
            'created_at' => 'تاریخ ایجاد',
            'updated_at' => 'تاریخ بروزرسانی',
            'deleted_at' => 'تاریخ حذف'
        ]);

        $crud->fieldType('gender', 'dropdown', [
            '' => 'انتخاب جنسیت',
            'male' => 'مرد',
            'female' => 'زن'
        ]);

        $crud->fieldType('type', 'dropdown', [
            '' => 'انتخاب جنسیت',
            'person' => 'حقیقی',
            'company' => 'حقوقی'
        ]);


        $crud->fieldType('status', 'dropdown', [
            '' => 'انتخاب وضعیت',
            'V' => 'تایید شده',
            'NV' => 'تایید نشده'
        ]);



        $output = $crud->render();


        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');
    }
}
