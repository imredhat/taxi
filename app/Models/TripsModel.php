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
        'dsc',
        'trip_type',
        'userCustomFare',
        'driverCustomFare',
        'package',
        'driverID',
        'carID',
        'reqID',
        'bank',
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
            driver.ax as driver_ax, driver.name as driver_name, driver.lname as driver_lname,trips.*,
            driver.mobile as driver_mobile, 
            cars.cid as cars_cid, cars.brand as cars_brand, cars.fuel as cars_fuel, cars.iran as cars_iran, 
            cars.pelak as cars_pelak, cars.harf as cars_harf, cars.pelak_last as cars_pelak_last, 
            cars.pic_front as cars_pic_front, cars.type as cars_type,
            packages.*,
            brand.brand as brand_name,brand_type.type_name as type_name
            '
        );

        $builder->join('request', 'request.id = trips.reqID', 'left');
        $builder->join('driver', 'driver.did = trips.driverID', 'left');
        $builder->join('cars', 'cars.cid = trips.carID', 'left');
        $builder->join('brand', 'cars.brand = brand.TiD', 'left');
        $builder->join('packages', 'packages.name = trips.package', 'left');
        $builder->join('brand_type', 'cars.type = brand_type.bid', 'left');

        $builder->where('trips.id', $tripId);

        $query = $builder->get();
        return $query->getRowArray();

        // $builder->select(
        //     'trips.*, 
        //     request.id as request_id, request.notifID, request.driverID, request.carID, request.isAccepted, 
        //     request.created_at as request_created_at, request.updated_at as request_updated_at, 
        //     driver.ax as driver_ax, driver.name as driver_name, driver.lname as driver_lname, 
        //     driver.mobile as driver_mobile, 
        //     cars.cid as cars_cid, cars.brand as cars_brand, cars.fuel as cars_fuel, cars.iran as cars_iran, 
        //     cars.pelak as cars_pelak, cars.harf as cars_harf, cars.pelak_last as cars_pelak_last, 
        //     cars.pic_front as cars_pic_front, cars.type as cars_type'
        // );

        // $builder->join('request', 'request.tripID = trips.id', 'left');
        // $builder->join('driver', 'driver.did = request.driverID', 'left');
        // $builder->join('cars', 'cars.driver_id = request.driverID', 'left');
        // $builder->where('trips.id', $tripId);

        // $query = $builder->get();
        // return $query->getRowArray();
    }


    public function getNewRequest($type_class)
    {
        $builder = $this->db->table($this->table);

        $builder->select(
            'trips.id,startAdd,endAdd,startPoint,endPoint, weather,distance,TimeMin,isWait,trip_date,trip_time,trips.dsc,status,trip_type,trips.created_at,driverCustomFare,package,
            request.isAccepted as isReserved, 
            packages.dsc as package_dsc,
            '
        );

        $builder->join('request', 'request.id = trips.reqID', 'left');
        $builder->join('packages', 'packages.name = trips.package', 'left');


        $type_class = preg_replace('/[^a-zA-Z]/', '', $type_class);
        $builder->where('package' , $type_class);
        // $builder->where('status' , "Notifed");


        if($query = $builder->get()){
            return $query->getResultArray();
        } else {
            return [];
        }
    }




    public function getMyRequest($driverID,$from_date=null,$to_date=null)
    {
        $builder = $this->db->table($this->table);

        $builder->select(
            'trips.id,startAdd,endAdd,startPoint,endPoint, weather,distance,TimeMin,isWait,trip_date,trip_time,trips.dsc,status,trip_type,trips.created_at,driverCustomFare,package,
            request.isAccepted as isReserved, 
            packages.dsc as package_dsc,
            '
        );

        $builder->join('request', 'request.id = trips.reqID', 'left');
        $builder->join('packages', 'packages.name = trips.package', 'left');


        $builder->where('trips.driverID' , $driverID);
        $builder->where('trips.status' , "Done");

        if(!empty($from_date)){
            $builder->where('trips.trip_date >=' , $from_date);
            $builder->where('trips.trip_date <' , $to_date);
        }


        if($query = $builder->get()){
            return $query->getResultArray();
        } else {
            return [];
        }
    }



}
