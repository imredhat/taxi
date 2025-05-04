<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $table = 'driver';
    protected $primaryKey = 'did';
    protected $allowedFields = [
        'code',
        'ax', 
        'name', 
        'lname', 
        'gender', 
        'mobile', 
        'mobile2', 
        'password', 
        'birthday', 
        'phone', 
        'address', 
        'work_type', 
        'melli', 
        'scan_melli', 
        'bank', 
        'shaba', 
        'education_level', 
        'foreign_language', 
        'foreign_language_proficiency', 
        'postal_code', 
        'note',
        'hash',
        'scan_govahiname',
        'ws_id',
        'status'
    ];

    protected $returnType = 'array';
    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected $skipValidation = false;

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
                c.year,

                b.brand AS brand_name,
                ct.type_name
                
            ')
            ->join('cars c', 'd.did = c.driver_id')
            ->join('brand b', 'c.brand = b.TiD')
            ->join('brand_type ct', 'c.type = ct.bid', 'left')
            ->where('d.did', $driverId)
            ->where('c.cid', $carId)
            ->get()
            ->getRowArray();
    }

    public function getDriverWithCars($driverId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('did', $driverId);
        $builder->join('cars', 'driver.did = cars.driver_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllDriverWithCars()
    {
        $builder = $this->db->table(tableName: $this->table);
        $builder->select('did,ax,name,lname,cid,cars.brand as brand_id,type,brand.brand,brand_type.type_name,cars.color ,driver.code');
        $builder->join('cars', 'driver.did = cars.driver_id', 'left');
        $builder->join('brand', 'cars.brand = brand.TiD', 'left');
        $builder->join('brand_type', 'cars.type = brand_type.bid', 'left');
        
        $query = $builder->get();
        return $query->getResultArray();
    }



    


    
}
