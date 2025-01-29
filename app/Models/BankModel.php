<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = 'bnks';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'title',
        'bank_name',
        'holder_name',
        'card_number',
        'shaba',
        'active'
    ];

    public $timestamps = false;

}
?>