<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleryCulinaryPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'culinary_place_id' => [
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
        $this->forge->addForeignKey('culinary_place_id', 'culinary_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gallery_culinary_place');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_culinary_place');
    }
}
