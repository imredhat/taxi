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

        $crud->setActionButton('کارت مشترک', 'fa fa-user UserTab', function ($row) {
            return '/UserCard/' . $row;
        }, true);

        $crud->requiredFields(['name']);
        $crud->columns([
            'id',
            'name',
            'lname',
            'gender',
            'mobile',
            'type',
            'status',
            'created_at'
        ]);

        $crud->fields([
            'name',
            'lname',
            'gender',
            'mobile',
            'phone',
            'type',
            'status',
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
            'created_at' => 'شروع اشتراک',
            'updated_at' => 'تاریخ بروزرسانی',
            'deleted_at' => 'تاریخ حذف',
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


        $crud->callbackColumn('created_at', function ($value) {
            $date = new PersianDate();
            list($gy, $gm, $gd) = explode('-', substr($value, 0, 10));
            return $date->gregorianToJalali($gy, $gm, $gd, '/');
        });


        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('crud', (array) $output);
        echo view('parts/footer_crud');

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
}
