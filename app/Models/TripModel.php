<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'estelam';  // Update with your actual table name
    protected $primaryKey = 'id';

    protected $useSoftDeletes = true;  // If you are using soft deletes (deleted_at)

    // The fields that are allowed to be set via insert/update
    protected $allowedFields = [
        'start_loc',
        'end_loc',
        'start_loc_text',
        'end_loc_text',
        'distance',
        'fare',
        'isHoliday',
        'roadCondition',
        'weather',
        'carType',
        'travelTime',
        'passenger_id',
        'passenger_name',
        'passenger_tel',
        'isGuest',
        'guest_name',
        'guest_tel',
        'company_factor',
        'company_name',
        'trip_date',
        'trip_time',
        'total_passenger',
        'start_address_desc',
        'end_address_desc',
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
