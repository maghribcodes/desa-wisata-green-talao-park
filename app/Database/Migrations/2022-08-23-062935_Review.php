<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Review extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                // 'constraint' => 5,
            ],
            'users_id' => [
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
            'tourism_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
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
            'souvenir_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'culinary_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'worship_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'government_place_id' => [
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
        $this->forge->addForeignKey('tourism_id', 'tourism', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('attraction_id', 'tourism_attraction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('event_id', 'tourism_event', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('souvenir_place_id', 'souvenir_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('culinary_place_id', 'culinary_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('worship_place_id', 'worship_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('government_place_id', 'government_place', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}
