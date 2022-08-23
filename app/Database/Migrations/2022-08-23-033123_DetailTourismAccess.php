<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailTourismAccess extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tourism_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
            'tourism_access_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE,
            ],
        ]);

        $this->forge->addKey('tourism_id', TRUE);
        $this->forge->addKey('tourism_access_id', TRUE);
        $this->forge->addForeignKey('tourism_id', 'tourism', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tourism_access_id', 'tourism_access', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_facility_access');
    }

    public function down()
    {
        $this->forge->dropTable('detail_facility_access');
    }
}
