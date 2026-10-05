<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $users = new UserModel();
        $records = $users->findAll();
        $initialHash = password_hash('ChangeMe123!', PASSWORD_DEFAULT);

        if ($records === []) {
            $users->insert([
                'username' => 'admin',
                'full_name' => 'POS Administrator',
                'role' => 'Admin',
                'password' => $initialHash,
            ]);

            return;
        }

        foreach ($records as $user) {
            if (empty($user['password'])) {
                $users->update($user['id'], ['password' => $initialHash]);
            }
        }
    }
}
