<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusAduanMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'status_aduan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id_status', true);
        $this->forge->createTable('status_aduan', true);
    }

    public function down()
    {
        $this->forge->dropTable('status_aduan', true);
    }
}
