<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TourismEvent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tourism_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'date_start' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'date_end' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'time_start' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'time_end' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'recurs' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'max_recurs' => [
                'type' => 'INT',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'geom' => [
                'type' => 'GEOMETRY',
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
        $this->forge->createTable('tourism_event');
    }

    public function down()
    {
        $this->forge->dropTable('tourism_event');
    }
}
