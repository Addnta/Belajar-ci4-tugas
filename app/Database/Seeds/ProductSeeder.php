<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'nama' => 'Asus TUF A15',
                'harga' => 12000000,
                'jumlah' => 5,
                'foto' => 'asus_tuf_a15.jpg'
            ],

            [
                'nama' => 'Asus Vivobook 14',
                'harga' => 8000000,
                'jumlah' => 7,
                'foto' => 'asus_vivobook_14.jpg'
            ],

            [
                'nama' => 'Lenovo Ideapad Slim 3',
                'harga' => 7500000,
                'jumlah' => 4,
                'foto' => 'lenovo_idepad_slim_3.jpg'
            ]

        ];

        $this->db->table('product')->insertBatch($data);
    }
}