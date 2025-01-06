<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'TiD';
    protected $allowedFields = [
        'brand'
        ];

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

}