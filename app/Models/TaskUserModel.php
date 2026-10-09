<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskUserModel extends Model
{
    protected $DBGroup = 'taskmanager';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'username',
        'full_name',
        'email',
        'created_at',
        'password',
    ];
    protected $useTimestamps = false;
}
