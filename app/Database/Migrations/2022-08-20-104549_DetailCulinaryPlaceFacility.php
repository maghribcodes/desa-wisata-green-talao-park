<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailCulinaryPlaceFacility extends Migration
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
        $this->forge->createTable('detail_culinary_place_facility');
    }

    public function down()
    {
        $this->forge->dropTable('detail_culinary_place_facility');
    }
}
