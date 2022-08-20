<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TalaoVideo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'talao_id' => [
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
        $this->forge->addForeignKey('talao_id', 'talao', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('talao_video');
    }

    public function down()
    {
        $this->forge->dropTable('talao_video');
    }
}
