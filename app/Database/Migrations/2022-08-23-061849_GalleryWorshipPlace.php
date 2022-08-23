<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleryWorshipPlace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'worship_place_id' => [
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
        $this->forge->addForeignKey('worship_place_id', 'worship_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gallery_worship_place');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_worship_place');
    }
}
