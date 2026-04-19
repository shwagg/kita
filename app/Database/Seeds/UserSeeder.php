<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('users');
        $user  = $table->where('username', 'admin')->get()->getRowArray();

        if ($user !== null) {
            return;
        }

        $table->insert([
            'username'      => 'admin',
            'full_name'     => 'System Administrator',
            'role'          => 'admin',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
