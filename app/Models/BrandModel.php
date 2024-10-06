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

    // Optionally, you can define validation rules
    protected $validationRules = [
        'brand' => 'required|min_length[3]|max_length[255]',
        // Add other validation rules as needed
    ];
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}