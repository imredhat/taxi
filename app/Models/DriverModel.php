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


    public function getDriverCarInfo($driverId, $carId)
    {
        return $this->db->table('driver d')
            ->select('
                d.name AS driver_name,
                d.lname AS driver_lname,
                d.mobile,
                d.ax,

                c.fuel,
                c.iran,
                c.pelak,
                c.harf,
                c.pelak_last,
                c.type,

                b.brand AS brand_name,
            ')
            ->join('cars c', 'd.did = c.driver_id')
            ->join('brand b', 'c.brand = b.TiD')
            ->where('d.did', $driverId)
            ->where('c.cid', $carId)
            ->get()
            ->getRowArray();
    }


}