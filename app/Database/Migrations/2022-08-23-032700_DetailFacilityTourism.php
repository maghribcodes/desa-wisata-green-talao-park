<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailFacilityTourism extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tourism_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'facility_tourism_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
        ]);

        $this->forge->addKey('tourism_id', TRUE);
        $this->forge->addKey('facility_tourism_id', TRUE);
        $this->forge->addForeignKey('tourism_id', 'tourism', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facility_tourism_id', 'facility_tourism', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_facility_tourism');
    }

    public function down()
    {
        $this->forge->dropTable('detail_facility_tourism');
    }
}
