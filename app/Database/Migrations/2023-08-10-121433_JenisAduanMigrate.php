<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisAduanMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jenis' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'jenis_aduan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id_jenis', true);
        $this->forge->createTable('jenis_aduan', true);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_aduan', true);
    }
}
