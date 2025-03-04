<?php

namespace App\Models;

use CodeIgniter\Model;


class AppModel extends Model
{
    protected $table = 'app';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $fillable = [
        'appName',
        'version',
        'Link',
        'releaseDate'
    ];

    public $timestamps = true;

}