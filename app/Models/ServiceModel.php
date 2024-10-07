<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'passenger_id',
        'passenger_type',
        'driver_id',
        'car_id',
        'service_id',
        'category',
        'call_date',
        'trip_date',
        'start_location',
        'end_location',
        'price',
        'factor_status',
        'service_type',
        'service_status',
        'isPaid',
        'isTax',
        'extraPassenger',
        'extra',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;


    public function User()
    {
        return $this->belongsTo(UserModel::class, 'passenger_id', 'id');
    }


    public function getAllService()
    {
        return $this->select('service.*, user.name as passenger_name, user.lname as passenger_last,          driver.name as driver_name,driver.lname as driver_last,driver.ax as driver_photo' )
        ->join('user', 'user.id = service.passenger_id')
        ->join('driver', 'driver.did = service.driver_id')
        ->findAll();
}
}
