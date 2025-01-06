<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tripID',
        'userCustomFare',
        'driverCustomFare',
        'package',
        'created_at',
    ];

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';

    public function getAllNotificationsWithTrips($DriverID)
    {
        return $this->select('notification.*, trips.*')
            ->join('trips', 'notification.tripID = trips.id')
            ->where('trips.status', 'Notified')
            ->where('trips.status', 'Notified')
            ->findAll();
    }

}
