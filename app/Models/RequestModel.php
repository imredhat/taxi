<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table = 'request';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'notifID', 
        'tripID', 
        'driverID', 
        'carID', 
        'isAccepted', 
        'status', 
        'created_at', 
        'updated_at'
    ];

    public function getAllRequestWithDetail($requestId)
    {
        $builder = $this->db->table($this->table)
            ->select('
                request.id AS request_id,
                request.notifID,
                request.tripID,
                request.driverID,
                request.carID,
                request.isAccepted,
                request.created_at AS request_created_at,
                request.updated_at AS request_updated_at,
                
                notification.id AS notification_id,
                notification.userCustomFare,
                notification.driverCustomFare,
                notification.created_at AS notification_created_at,
                notification.updated_at AS notification_updated_at,
                
                trips.id AS trip_id,
                trips.toll,
                trips.endAdd,
                trips.weather,
                trips.startAdd,
                trips.distance,
                trips.waitRate,
                trips.endPoint,
                trips.badRoadKM,
                trips.finalFare,
                trips.Waithours,
                trips.startPoint,
                trips.badRoadRate,
                trips.travelTime,
                trips.weatherRate,
                trips.roadCondition,
                trips.isFriday,
                trips.passengerRate,
                trips.package,
                trips.holiDayRate,
                trips.extraPassenger,
                trips.TimeMin,
                trips.fare,
                trips.badRoad,
                trips.isWait,
                trips.isGuest,
                trips.trip_date,
                trips.trip_time,
                trips.company_name,
                trips.passenger_id,
                trips.passenger_tel,
                trips.guest_name,
                trips.guest_tel,
                trips.passenger_name,
                trips.total_passenger,
                trips.end_address_desc,
                trips.start_address_desc,
                trips.status AS trip_status,
                trips.created_at AS trip_created_at,
                trips.updated_at AS trip_updated_at,
                trips.deleted_at,

                driver.ax as driver_ax,
                driver.name driver_name,
                driver.lname as driver_lname,
                driver.mobile driver_mobile,

                cars.cid 				as cars_cid ,
                cars.brand                 as cars_brand ,
                cars.fuel                 as cars_fuel ,
                cars.iran                 as cars_iran ,
                cars.pelak                 as cars_pelak ,
                cars.harf                 as cars_harf ,
                cars.pelak_last                 as cars_pelak_last ,
                cars.pic_front                 as cars_pic_front ,
                cars.type                 as cars_type ,
                
            ')
            ->join('notification', 'request.notifID = notification.id')
            ->join('trips', 'request.tripID = trips.id')
            ->join('driver', 'request.driverID = driver.did')
            ->join('cars', 'request.carID = cars.cid');

            $builder->where('request.id', $requestId);

        $query = $builder->get();
        return $query->getResultArray();
    }


    public function getNewRequest($DriverID , $CarID)
    {
        $builder = $this->db->table($this->table)
            ->select('
                request.id AS request_id,
                request.notifID,
                request.tripID,
                request.driverID,
                request.carID,
                request.isAccepted,
                request.created_at AS request_created_at,
                request.updated_at AS request_updated_at,
    
                
                trips.id,startAdd,endAdd,startPoint,endPoint, weather,distance,TimeMin,travelTime,isWait,trip_date,trip_time,trips.dsc,status,trip_type,trips.created_at,driverCustomFare,package,total_passenger,


                
            ')
            ->join('trips', 'request.tripID = trips.id');

            // $builder->where('request.driverID', $DriverID);
            // $builder->where('request.carID', $CarID);

        $query = $builder->get();
        return $query->getResultArray();
    }



}
