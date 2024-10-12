<?php

namespace App\Controllers;

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


    public function saveSettings()
    {
        // بررسی اینکه درخواست از نوع POST است یا خیر

        $packages = [];
        $weather = [];
        $road = [];

        $model = new FareModel();

        // گرفتن مقادیر ورودی از فرم

        $price_per_km           = $this->request->getPost('price_per_km');
        $holiday_rate           = $this->request->getPost('holiday_rate');

        $eco_rate               = $this->request->getPost('eco_rate');
        $eco_plus_rate          = $this->request->getPost('eco_plus_rate');
        $vip_rate               = $this->request->getPost('vip_rate');
        $vip_plus_rate          = $this->request->getPost('vip_plus_rate');
        $vip_suv_rate           = $this->request->getPost('vip_suv_rate');

        $sunny_rate             = $this->request->getPost('sunny_rate');
        $rainy_rate             = $this->request->getPost('rainy_rate');
        $snowy_rate             = $this->request->getPost('snowy_rate');

        $normal_road_rate       = $this->request->getPost('normal_road_rate');
        $good_highway_rate      = $this->request->getPost('good_highway_rate');
        $bad_highway_rate       = $this->request->getPost('bad_highway_rate');
        $good_dirt_road_rate    = $this->request->getPost('good_dirt_road_rate');
        $bad_dirt_road_rate     = $this->request->getPost('bad_dirt_road_rate');

        $packages = [
            'eco_rate' => $eco_rate,
            'eco_plus_rate' => $eco_plus_rate,
            'vip_rate' => $vip_rate,
            'vip_plus_rate' => $vip_plus_rate,
            'vip_suv_rate' => $vip_suv_rate
        ];

        $weather = [
            'sunny_rate' => $sunny_rate,
            'rainy_rate' => $rainy_rate,
            'snowy_rate' => $snowy_rate
        ];

        $road = [
            'normal_road_rate' => $normal_road_rate,
            'good_highway_rate' => $good_highway_rate,
            'bad_highway_rate' => $bad_highway_rate,
            'good_dirt_road_rate' => $good_dirt_road_rate,
            'bad_dirt_road_rate' => $bad_dirt_road_rate
        ];

        // Update isHoliday rate
        $data1 = ["rate" => $holiday_rate];

        $model->where("option", "isHoliday")->set($data1)->update();


        // Update price per km
        $data2 = ["rate" => $price_per_km];
        $model->where("option", "pp_km")->set($data2)->update();

        // Update packages rates
        $data3 = ["rate" => json_encode($packages)];
        $model->where("option", "carType")->set($data3)->update();

        // Update weather rates
        $data4 = ["rate" => json_encode($weather)];
        $model->where("option", "weather")->set($data4)->update();

        // Update road condition rates
        $data5 = ["rate" => json_encode($road)];
        $model->where("option", "roadCondition")->set($data5)->update();

        echo "<script>alert('تنظیمات ذخیره شد') </script>";

        return redirect()->to('Option');
    }
}
