<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jenis_aduan';
    protected $primaryKey       = 'id_jenis';
    protected $useAutoIncrement = true;
    protected $insertID         = 75934;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_aduan',
    ];
}
