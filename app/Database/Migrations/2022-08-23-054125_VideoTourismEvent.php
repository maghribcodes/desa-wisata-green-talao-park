<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VideoTourismEvent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'event_id' => [
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
        $this->forge->addForeignKey('event_id', 'tourism_event', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('video_tourism_event');
    }

    public function down()
    {
        $this->forge->dropTable('video_tourism_event');
    }
}
