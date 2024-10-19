<?php

namespace App\Models;

use CodeIgniter\Model;

class CarTypeModel extends Model
{
    protected $table = 'fare_option_cartype';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'base_fare',
        'long_fare',
        'distance_rate',
        'time_rate'
    ];

}
