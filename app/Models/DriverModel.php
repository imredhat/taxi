<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $table = 'driver';
    protected $primaryKey = 'did';
    protected $allowedFields = [
        'ax',
        'name',
        'lname',
        'gender',
        'mobile',
        'mobile2',
        'phone',
        'address',
        'work_type',
        'melli',
        'scan_melli',
        'bank',
        'shaba',
        'note',
        'date_created'
    ];

    // Optionally, you can define validation rules
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'lname' => 'required|min_length[3]|max_length[255]',
        'mobile' => 'required|numeric',
        // Add other validation rules as needed
    ];
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}