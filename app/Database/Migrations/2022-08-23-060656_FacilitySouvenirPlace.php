<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FacilitySouvenirPlace extends Migration
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
        $this->forge->createTable('facility_souvenir_place');
    }

    public function down()
    {
        $this->forge->dropTable('facility_souvenir_place');
    }
}
