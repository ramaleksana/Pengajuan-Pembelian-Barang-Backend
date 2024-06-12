<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'officer',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'Officer',
            ],
            [
                'username' => 'manager',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'Manager',
            ],
            [
                'username' => 'finance',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'Finance',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
