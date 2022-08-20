<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
            'price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'menu_image' => [
                'type' => 'VARCHAR',
                'null' => 255,
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
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
