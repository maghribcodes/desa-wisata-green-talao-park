<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailWorshipPlaceFacility extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'worship_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'facility_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'condition_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
        ]);

        $this->forge->addKey('worship_place_id', TRUE);
        $this->forge->addKey('facility_id', TRUE);
        $this->forge->addForeignKey('condition_id', 'facility_condition', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_worship_place_facility');
    }

    public function down()
    {
        $this->forge->dropTable('detail_worship_place_facility');
    }
}
