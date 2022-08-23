<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailFacilitySouvenirPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'souvenir_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'facility_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
        ]);

        $this->forge->addKey('souvenir_place_id', TRUE);
        $this->forge->addKey('facility_id', TRUE);
        $this->forge->addForeignKey('souvenir_place_id', 'souvenir_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facility_id', 'facility_souvenir_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_facility_souvenir_place');
    }

    public function down()
    {
        $this->forge->dropTable('detail_facility_souvenir_place');
    }
}
