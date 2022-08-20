<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FacilityGallery extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'facility_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'url' => [
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
        $this->forge->addForeignKey('facility_id', 'facility', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('facility_gallery');
    }

    public function down()
    {
        $this->forge->dropTable('facility_gallery');
    }
}
