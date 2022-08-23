<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailFacilityCulinaryPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'culinary_place_id' => [
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

        $this->forge->addKey('culinary_place_id', TRUE);
        $this->forge->addKey('facility_id', TRUE);
        $this->forge->addForeignKey('culinary_place_id', 'culinary_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facility_id', 'facility_culinary_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_facility_culinary_place');
    }

    public function down()
    {
        $this->forge->dropTable('detail_facility_culinary_place');
    }
}
