<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TasksToday extends BaseController
{
    public function index(): string
    {
        return view('tasks/today', [
            'title' => 'Tasks for Today',
            'tasks' => (new TaskModel())->forToday(),
        ]);
    }
}
