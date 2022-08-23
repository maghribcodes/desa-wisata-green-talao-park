<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TourismAttraction extends Migration
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
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'geom' => [
                'type' => 'GEOMETRY',
                'null' => true,
            ],
            'geom_area' => [
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
        $this->forge->createTable('tourism_attraction');
    }

    public function down()
    {
        $this->forge->dropTable('tourism_attraction');
    }
}
