<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AttractionVideo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'attraction_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'duration' => [
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
        $this->forge->addForeignKey('attraction_id', 'attraction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attraction_video');
    }

    public function down()
    {
        $this->forge->dropTable('attraction_video');
    }
}
