<?php

namespace App\Database\Seeds;

use App\Entities\User;
use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        // Role / Group User -------------------------------
        $this->db->table('auth_groups')->insertBatch([
            ["name"        => 'admin', "description" => 'site administration'],
            ["name"        => 'petugas', "description" => 'petugas pelayanan'],
            ["name"        => 'pengguna', "description" => 'general user'],
        ]);


        // Setup -------------------------------------------
        $fake = \Faker\Factory::create('id_ID');


        // Admin User --------------------------------------
        $userData = new User([
            'email'         => $fake->freeEmail(),
            'username'      => 'admin',
            'password'      => 'admin',

            'nama'          => $fake->name,
            'tempat_lahir'  => $fake->city,
            'nomor_hp'      => $fake->e164PhoneNumber(),
            'tanggal_lahir' => '2001-01-01',
            'agama'         => $fake->randomElement(['islam', 'kristen', 'hindu', 'budha', 'konghucu']),
            'jenis_kelamin' => $fake->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan'     => $fake->jobTitle,
            'alamat'        => $fake->address,

            'active'        => 1,
        ]);

        $userModal = new \App\Models\UserModel();
        $userModal->withGroup('admin')->save($userData);

        // Petugas User --------------------------------------
        for ($i = 0; $i < 3; $i++) {
            $petugasData = new User([
                'email'         => $fake->freeEmail(),
                'username'      => "petugas".($i + 1),
                'password'      => "petugas".($i + 1),

                'nama'          => $fake->name,
                'tempat_lahir'  => $fake->city,
                'nomor_hp'      => $fake->e164PhoneNumber(),
                'tanggal_lahir' => '2001-01-01',
                'agama'         => $fake->randomElement(['islam', 'kristen', 'hindu', 'budha', 'konghucu']),
                'jenis_kelamin' => $fake->randomElement(['laki-laki', 'perempuan']),
                'pekerjaan'     => $fake->jobTitle,
                'alamat'        => $fake->address,

                'active'        => 1,
            ]);

            $userModal = new \App\Models\UserModel();
            $userModal->withGroup('petugas')->save($petugasData);
        }

        // Pengguna User --------------------------------------
        for ($i = 0; $i < 7; $i++) {
            $penggunaData = new User([
                'email'         => $fake->freeEmail(),
                'username'      => "warga".($i + 1),
                'password'      => "warga".($i + 1),

                'nama'          => $fake->name,
                'tempat_lahir'  => $fake->city,
                'nomor_hp'      => $fake->e164PhoneNumber(),
                'tanggal_lahir' => '2001-01-01',
                'agama'         => $fake->randomElement(['islam', 'kristen', 'hindu', 'budha', 'konghucu']),
                'jenis_kelamin' => $fake->randomElement(['laki-laki', 'perempuan']),
                'pekerjaan'     => $fake->jobTitle,
                'alamat'        => $fake->address,

                'active'        => 1,
            ]);

            $userModal = new \App\Models\UserModel();
            $userModal->withGroup('pengguna')->save($penggunaData);
        }
    }
}
