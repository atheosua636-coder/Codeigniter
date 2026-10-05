<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $DBGroup = 'taskmanager';
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'title',
        'status',
        'task_date',
        'created_at',
    ];
    protected $useTimestamps = false;

    public function forToday(): array
    {
        return $this->where('task_date', date('Y-m-d'))
            ->orderBy('task_date', 'ASC')
            ->findAll();
    }

    public function allByDate(): array
    {
        return $this->orderBy('task_date', 'ASC')
            ->findAll();
    }
}
