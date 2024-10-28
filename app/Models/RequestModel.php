<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table = 'request';
    protected $primaryKey = 'id';
    protected $allowedFields = ['notifID', 'tripID', 'driverID', 'carID', 'isAccepted', 'status', 'created_at', 'updated_at'];
}
