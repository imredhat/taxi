<?php

namespace App\Models;

use CodeIgniter\Model;

class TripsModel extends Model
{
    protected $table      = 'trips';  
    protected $primaryKey = 'id';

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
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function isAcceptedExists($tripID, $notifID)
    {
        $result = $this->where('tripID', $tripID)
                       ->where('notifID', $notifID)
                       ->where('isAccepted', true)
                       ->countAllResults();
        
        return $result > 0;
    }
}
