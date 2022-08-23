<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleryTourism extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'tourism_id' => [
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
        $this->forge->addForeignKey('tourism_id', 'tourism', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gallery_tourism');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_tourism');
    }
}
