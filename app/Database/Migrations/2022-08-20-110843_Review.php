<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Review extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'rating' => [
                'type' => 'INT',
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'attraction_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'event_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
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
        $this->forge->addForeignKey('event_id', 'event', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}
