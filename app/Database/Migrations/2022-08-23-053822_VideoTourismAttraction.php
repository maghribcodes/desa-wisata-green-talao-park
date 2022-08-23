<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VideoTourismAttraction extends Migration
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
        $this->forge->addForeignKey('attraction_id', 'tourism_attraction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('video_tourism_attraction');
    }

    public function down()
    {
        $this->forge->dropTable('video_tourism_attraction');
    }
}
