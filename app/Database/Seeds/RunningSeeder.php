<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunningSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeed');
        $this->call('AduanSeed');
    }
}
