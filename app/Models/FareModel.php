<?php

namespace App\Models;

use CodeIgniter\Model;

class FareModel extends Model
{
   protected $table = 'option';
    protected $primaryKey = 'id';
    protected $allowedFields = ['option', 'name', 'values', 'rate'];

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}

