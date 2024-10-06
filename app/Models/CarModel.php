<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'cid';
    protected $allowedFields = [
        'driver_id',
        'brand',
        'fuel',
        'iran',
        'pelak',
        'harf',
        'pelak_last',
        'motor',
        'pic_back',
        'pic_front',
        'pic_in_back',
        'pic_in_front',
        'scan_car_id',
        'shasi',
        'type',
        'vin'
    ];

    public function GetDriverCars($id)
    {
        return $this->select('cars.cid,cars.driver_id ,cars.brand,cars.pelak,cars.iran,cars.harf,cars.pelak_last,brand.brand as car_brand' )
        ->join('brand', 'brand.TiD = cars.brand')
        ->where('driver_id' , $id)
        ->findAll();
}
}
