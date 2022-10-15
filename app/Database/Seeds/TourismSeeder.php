<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TourismSeeder extends Seeder
{
    public function run()
    {
        $rows = array_map('str_getcsv', file(WRITEPATH . 'seeds/' . 'tourism.csv'));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = [
                'id' => $row[0],
                'name' => $row[1],
                'type_of_tourism' => $row[2],
                'address' => $row[3],
                'open' => $row[4],
                'close' => $row[5],
                'ticket_price' => $row[6],
                'contact_person' => $row[7],
                'description' => $row[8],
                'geom' => $row[9],
                'geom_area' => $row[10],
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];

            $this->db->table('tourism')->insert($data);
            $this->db->table('tourism')->set('geom', $row[6], false)->where('id', $row[0])->update();
        }
    }
}
