<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailSouvernirPlaceFacility extends Migration
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
        $this->forge->createTable('detail_souvenir_place_facility');
    }

    public function down()
    {
        $this->forge->dropTable('detail_souvenir_place_facility');
    }
}
