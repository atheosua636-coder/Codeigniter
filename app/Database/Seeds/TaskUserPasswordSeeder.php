<?php

namespace App\Database\Seeds;

use App\Models\TaskUserModel;
use CodeIgniter\Database\Seeder;

class TaskUserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $users = new TaskUserModel();
        $initialHash = password_hash('ChangeMe123!', PASSWORD_DEFAULT);
        $demoUser = $users->where('username', 'atheo')->first();

        if ($demoUser === null) {
            $users->insert([
                'username' => 'atheo',
                'full_name' => 'Atheo Carl C. Sua',
                'email' => 'your-email@example.com',
                'created_at' => date('Y-m-d H:i:s'),
                'password' => $initialHash,
            ]);
        } elseif (empty($demoUser['password'])) {
            $users->update($demoUser['id'], ['password' => $initialHash]);
        }
    }
}
