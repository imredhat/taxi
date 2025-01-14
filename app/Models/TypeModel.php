<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table = 'brand_type';
    protected $primaryKey = 'bid';
    protected $allowedFields = [
        'type_name',
        'type_class',
        'type_brand'
        ];

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

  

}