<?php

namespace App\Models;

use CodeIgniter\Model;

class AduanModel extends Model
{
    protected $table            = 'aduan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 894032;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'nomor', 'status', 'tanggal',
        'jenis', 'judul', 'lokasi', 'keterangan',
        'foto', 'latlang'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
