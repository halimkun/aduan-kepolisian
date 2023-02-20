<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AduanSeed extends Seeder
{
    public function run()
    {
        // Setup -------------------------------------------
        $fake = \Faker\Factory::create('id_ID');
        $userModel = new \App\Models\UserModel();

        // get all pengguna user
        $pengguna = [];
        foreach ($userModel->findAll() as $user) {
            if ($userModel->getRole($user->id)->name == 'pengguna') {
                $pengguna[] = $user->id;
            }
        }

        // Jenis Aduan --------------------------------------
        $jenis = [
            'pencurian', 'tindak kriminal', 'kekerasan', 'kehilangan',
            'kecelakaan lalu lintas', 'tindak kriminal di internet'
        ];

        // Aduan --------------------------------------
        // // create 10 aduan in month october - now and random user

        for ($i = 0; $i < $fake->numberBetween(20, 48); $i++) {
            $ids = $fake->randomElement($pengguna);
            $ad = [
                'user_id' => $ids,
                'nomor' => $fake->unique()->randomNumber(8),
                'status' => $fake->randomElement(['belum diproses', 'dalam proses', 'selesai', 'dibatalkan']),
                'tanggal' => $fake->dateTimeBetween('-5 month', 'now')->format('Y-m-d H:i:s'),
                'jenis' => $fake->randomElement($jenis),
                'judul' => $fake->sentence(6),
                'lokasi' => $fake->address,
                'keterangan' => $fake->paragraph(3),
                'foto' => $fake->imageUrl(640, 480, 'animals', true, 'Faker'),
            ];

            $this->db->table('aduan')->insert($ad);
        }

    }
}
