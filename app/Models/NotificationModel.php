<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'nitification';  
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tripID',
        'userCustomFare',
        'diiverCustomFare',
        'created_at'
    ];


    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
}
