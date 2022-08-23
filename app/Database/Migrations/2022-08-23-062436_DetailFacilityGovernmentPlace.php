<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailFacilityGovernmentPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'government_place_id' => [
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

        $this->forge->addKey('government_place_id', TRUE);
        $this->forge->addKey('facility_id', TRUE);
        $this->forge->addForeignKey('government_place_id', 'government_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facility_id', 'facility_government_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_facility_government_place');
    }

    public function down()
    {
        $this->forge->dropTable('detail_facility_government_place');
    }
}
