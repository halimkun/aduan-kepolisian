<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'status_aduan';
    protected $primaryKey       = 'id_status';
    protected $useAutoIncrement = true;
    protected $insertID         = 4387;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_aduan',
    ];
}
