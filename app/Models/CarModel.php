<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Events\Events;


class CarModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'cid';
    protected $allowedFields = [
        'driver_id',
        'brand',
        'fuel',
        'iran',
        'pelak',
        'harf',
        'pelak_last',
        'motor',
        'pic_back',
        'pic_front',
        'pic_in_back',
        'pic_in_front',
        'scan_car_id',
        'shasi',
        'type',
        'vin'
    ];
    

    public function GetDriverCars($id)
    {
        return $this->select('cars.cid,cars.driver_id ,cars.brand,cars.pelak,cars.iran,cars.harf,cars.pelak_last,brand.brand as car_brand , cars.type,cars.*')
            ->join('brand', 'brand.TiD = cars.brand')
            ->where('driver_id', $id)
            ->findAll();
    }

    public function __construct()
    {
        parent::__construct();
        
        // ثبت رویدادها
        Events::on('afterInsert', [$this, 'logInsert']);
        Events::on('afterUpdate', [$this, 'logUpdate']);
        Events::on('afterDelete', [$this, 'logDelete']);
    }

    public function logInsert($data)
    {
        $this->logAction('insert', $data['id'], 'درج رکورد جدید');
    }

    public function logUpdate($data)
    {
        $this->logAction('update', $data['id'], 'بروزرسانی رکورد');
    }

    public function logDelete($data)
    {
        $this->logAction('delete', $data['id'], 'حذف رکورد');
    }

    protected function logAction($action, $recordId, $description)
    {
        $db = \Config\Database::connect();
        $database_name = $db->database;

        // نام جدول
        $table_name = $this->table;

        // دریافت آخرین Query
        $lastQuery = $this->getLastQuery();
        $queryText = $lastQuery ? $lastQuery->getQuery() : '';

        // درج لاگ در جدول database_logs
        $db->query("INSERT INTO database_logs (action, table_name, record_id, user_id, query, database, description) VALUES (?, ?, ?, ?, ?, ?, ?)", [
            $action,
            $table_name,
            $recordId,
            session()->get('user_id') ?? null,
            $queryText, // متن کامل Query
            $database_name,
            $description
        ]);
    }
}
