<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTaskArchiveAndPassword extends Migration
{
    protected $DBGroup = 'taskmanager';

    public function up(): void
    {
        if (! $this->db->fieldExists('password', 'users')) {
            $this->forge->addColumn('users', [
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
            ]);
        }

        if (! $this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->addColumn('tasks', [
                'is_archived' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 0,
                    'null'       => false,
                ],
            ]);
        }

        $hash = password_hash('ChangeMe123!', PASSWORD_DEFAULT);
        $this->db->table('users')
            ->where('username', 'atheo')
            ->where('password', null)
            ->update(['password' => $hash]);
    }

    public function down(): void
    {
        if ($this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->dropColumn('tasks', 'is_archived');
        }
        if ($this->db->fieldExists('password', 'users')) {
            $this->forge->dropColumn('users', 'password');
        }
    }
}
