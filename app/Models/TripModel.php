<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'trips';  // Update with your actual table name
    protected $primaryKey = 'id';

    protected $useSoftDeletes = true;  // If you are using soft deletes (deleted_at)

    protected $allowedFields = [
        'toll',
        'endAdd',
        'weather',
        'startAdd',
        'distance',
        'waitRate',
        'endPoint',
        'badRoadKM',
        'finalFare',
        'Waithours',
        'startPoint',
        'badRoadRate',
        'travelTime',
        'weatherRate',
        'roadCondition',
        'isFriday',
        'passengerRate',
        'Packgae',
        'holiDayRate',
        'extraPassenger',
        'TimeMin',
        'fare',
        'badRoad',
        'isWait',
        'isGuest',
        'trip_date',
        'trip_time',
        'company_name',
        'passenger_id',
        'passenger_tel',
        'passenger_name',
        'guest_name',
        'guest_tel',
        'total_passenger',
        'end_address_desc',
        'start_address_desc',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;
}
