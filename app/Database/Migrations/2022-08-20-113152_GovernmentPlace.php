<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GovernmentPlace extends Migration
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
            'employee' => [
                'type' => 'INT',
                'null' => true,
            ],
            'park_area_size' => [
                'type' => 'INT',
                'null' => true,
            ],
            'building_size' => [
                'type' => 'INT',
                'null' => true,
            ],
            'est' => [
                'type' => 'INT',
                'null' => true,
            ],
            'geom' => [
                'type' => 'GEOMETRY',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('government_place');
    }

    public function down()
    {
        $this->forge->dropTable('government_place');
    }
}
