<?php

namespace App\Database\Seeds;

use App\Entities\User;
use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $this->db->table('auth_groups')->insertBatch([
            [ "name"        => 'admin', "description" => 'site administration'],
            [ "name"        => 'pengguna', "description" => 'general user'],
        ]);
        

        // -------------------------------------------------
        $userData = new User([
            'email'         => 'int.halim@gmail.com',
            'username'      => 'admin',
            'password'      => 'admin',
            'nama'          => 'Nama Admin',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1990-01-01',
            'pekerjaan'     => 'Pengusaha',
            'alamat'        => 'Alamat Admin',
            'active'        => 1,
        ]);

        $userModal = new \App\Models\UserModel();
        $userModal->withGroup('admin')->save($userData);
    }
}
