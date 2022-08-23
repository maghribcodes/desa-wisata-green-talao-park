<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tourism extends Migration
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
            'type_of_tourism' => [
                'type' => 'VARCHAR',
                // 'type' => 'BOOLEAN',
                'constraint' => 50,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
            'ticket_price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            // 'status' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 255,
            //     'null' => true,
            // ],
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
        // $this->forge->addForeignKey('tourism_type_id', 'tourism_type', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tourism');
    }

    public function down()
    {
        $this->forge->dropTable('tourism');
    }
}
