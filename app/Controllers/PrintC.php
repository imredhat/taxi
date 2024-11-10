<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\BrandModel;
use App\Models\CarModel;
use App\Models\DriverModel;

class PrintC extends BaseController
{
        public function DriverCard()
    {
        $uri = service('uri');
        $ID = $uri->getSegment(3);


        $Driver = new DriverModel();
        $Driver = $Driver->where('did', $ID)->find()[0];
        $data['driver'] = $Driver;

        $Cars = new CarModel();
        $Cars = $Cars->GetDriverCars($ID);
        $data['car'] = $Cars;


        echo view('parts/print/header');
        echo view('driver_card', $data);
        echo view('parts/print/footer');

        echo "<script> window.print() </script>";
    }


}
