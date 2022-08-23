<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CulinaryPlace extends Migration
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
            'owner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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
            'open' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'close' => [
                'type' => 'TIME',
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
        $this->forge->createTable('culinary_place');
    }

    public function down()
    {
        $this->forge->dropTable('culinary_place');
    }
}
