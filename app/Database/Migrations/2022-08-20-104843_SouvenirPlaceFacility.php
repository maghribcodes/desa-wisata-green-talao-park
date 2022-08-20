<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SouvenirPlaceFacility extends Migration
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
        $this->forge->createTable('souvenir_place_facility');
    }

    public function down()
    {
        $this->forge->dropTable('souvenir_place_facility');
    }
}
