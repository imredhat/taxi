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
        'deleted_at',


        'trip_type',
        'userCustomFare',
        'driverCustomFare',
        'package',
        'driverID',
        'carID',
        'reqID',
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

    public function getTripDetails($tripId)
    {
        $builder = $this->db->table($this->table);
        $builder->select(
            'trips.*, 
            request.id as request_id, request.notifID, request.driverID, request.carID, request.isAccepted, 
            request.created_at as request_created_at, request.updated_at as request_updated_at, 
            notification.id as notification_id, notification.userCustomFare, notification.driverCustomFare, 
            notification.created_at as notification_created_at, notification.updated_at as notification_updated_at, 
            driver.ax as driver_ax, driver.name as driver_name, driver.lname as driver_lname, 
            driver.mobile as driver_mobile, 
            cars.cid as cars_cid, cars.brand as cars_brand, cars.fuel as cars_fuel, cars.iran as cars_iran, 
            cars.pelak as cars_pelak, cars.harf as cars_harf, cars.pelak_last as cars_pelak_last, 
            cars.pic_front as cars_pic_front, cars.type as cars_type'
        );

        $builder->join('request', 'request.tripID = trips.id', 'left');
        $builder->join('driver', 'driver.did = request.driverID', 'left');
        $builder->join('cars', 'cars.driver_id = request.driverID', 'left');
        $builder->where('trips.id', $tripId);

        $query = $builder->get();
        return $query->getRowArray();
    }

}
