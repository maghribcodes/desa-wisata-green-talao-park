<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SouvernirPlaceGallery extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'souvenir_place_id' => [
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
        $this->forge->addForeignKey('souvenir_place_id', 'souvenir_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('souvenir_place_gallery');
    }

    public function down()
    {
        $this->forge->dropTable('souvenir_place_gallery');
    }
}
