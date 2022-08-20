<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Village extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'district' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'geom' => [
                'type' => 'GEOMETRY',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('village');
    }

    public function down()
    {
        $this->forge->dropTable('village');
    }
}
