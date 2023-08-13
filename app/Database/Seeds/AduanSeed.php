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
        $jenisModel = new \App\Models\JenisModel();
        $jenis = [
            'pencurian', 'tindak kriminal', 'kekerasan', 'kehilangan',
            'kecelakaan lalu lintas', 'tindak kriminal di internet'
        ];

        foreach ($jenis as $jns) {
            $jenisModel->insert(['jenis_aduan' => $jns]);
        }

        // Status Aduan --------------------------------------
        $statusModel = new \App\Models\StatusModel();
        $status = [
            'belum diproses', 'dalam proses', 'selesai', 'dibatalkan', 'peninjauan lokasi',
        ];

        foreach ($status as $sts) {
            $statusModel->insert(['status_aduan' => $sts]);
        }

        // id jenis aduan
        $idj = [];
        foreach ($jenisModel->findAll() as $jns) {
            $idj[] = $jns->id_jenis;
        }

        // id status aduan
        $ids = [];
        foreach ($statusModel->findAll() as $sts) {
            $ids[] = $sts->id_status;
        }

        // Aduan --------------------------------------
        for ($i = 0; $i < $fake->numberBetween(144, 174); $i++) {
            $thisMonth = date('m');
            
            $ad = [
                'user_id' => $fake->randomElement($pengguna),
                'nomor' => $fake->unique()->randomNumber(8),
                'status' => $fake->randomElement($ids),
                'tanggal' => $fake->dateTimeBetween((-$thisMonth + 1)." month", 'now')->format('Y-m-d H:i:s'),
                'jenis' => $fake->randomElement($idj),
                'judul' => $fake->sentence(6),
                'lokasi' => $fake->address,
                'latlang' => $fake->latitude . ', ' . $fake->longitude, // 'lat,lng
                'keterangan' => $fake->paragraph(3),
                'foto' => $fake->imageUrl(640, 480, 'Aduan', false),
            ];

            $this->db->table('aduan')->insert($ad);
        }

    }
}
