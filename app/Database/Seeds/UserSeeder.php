<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'username' => 'karen13',
                'email' => 'karen@gmail.com',
                'password' => password_hash('1234567', PASSWORD_DEFAULT),
                'role' => 'admin'
            ],

            [
                'username' => 'guest01',
                'email' => 'guest@gmail.com',
                'password' => password_hash('1234567', PASSWORD_DEFAULT),
                'role' => 'guest'
            ]

        ];

        $this->db->table('user')->insertBatch($data);
    }
}