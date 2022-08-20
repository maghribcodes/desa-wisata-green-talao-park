<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'souvenir_place_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'product_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
        ]);

        $this->forge->addKey('souvenir_place_id', TRUE);
        $this->forge->addKey('product_id', TRUE);
        $this->forge->createTable('detail_product');
    }

    public function down()
    {
        $this->forge->dropTable('detail_product');
    }
}
