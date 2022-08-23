<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleryGovernmentPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'government_place_id' => [
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
        $this->forge->addForeignKey('government_place_id', 'government_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gallery_government_place');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_government_place');
    }
}
