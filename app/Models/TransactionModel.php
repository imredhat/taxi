<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'user_transaction';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'tel',          
        'amount',       
        'desc',         
        'trans_id',     
        'refid',        
        'date_p', 
        'response',     
        'status',
        'scan' ,
        '_from',
        '_to',
        '_for',
        'trip_id'
    ];

    // protected $useTimestamps = true;
    // protected $createdField = 'date_created';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;
}