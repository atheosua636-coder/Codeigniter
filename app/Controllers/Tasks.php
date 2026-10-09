<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    public function index(): string
    {
        return view('tasks/index', [
            'title' => 'Task List',
            'tasks' => (new TaskModel())->allByDate(),
        ]);
    }

    public function newForm(): string
    {
        return view('tasks/form', [
            'title' => 'New Task',
            'task' => ['title' => '', 'task_date' => '', 'status' => 'pending'],
            'action' => site_url('tasks'),
            'heading' => 'New Task',
        ]);
    }

    public function create(): RedirectResponse
    {
        $values = $this->validatedTask();
        if ($values === null) {
            return redirect()->back()->withInput();
        }

        (new TaskModel())->insert($values + [
            'created_at' => date('Y-m-d H:i:s'),
            'is_archived' => 0,
        ]);

        return redirect()->to(site_url('tasks'))
            ->with('message', 'Task created successfully.');
    }

    public function edit(int $id): string
    {
        $task = (new TaskModel())->where('is_archived', 0)->find($id);
        if ($task === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        return view('tasks/form', [
            'title' => 'Edit Task',
            'task' => $task,
            'action' => site_url('tasks/' . $id),
            'heading' => 'Edit Task',
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $model = new TaskModel();
        if ($model->where('is_archived', 0)->find($id) === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }
        $values = $this->validatedTask();
        if ($values === null) {
            return redirect()->back()->withInput();
        }

        $model->update($id, $values);

        return redirect()->to(site_url('tasks'))
            ->with('message', 'Task updated successfully.');
    }

    public function delete(int $id): RedirectResponse
    {
        $model = new TaskModel();
        if ($model->where('is_archived', 0)->find($id) === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $model->update($id, ['is_archived' => 1]);

        return redirect()->to(site_url('tasks'))
            ->with('message', 'Task archived successfully.');
    }

    /** @return array{title: string, task_date: string, status: string}|null */
    private function validatedTask(): ?array
    {
        $input = $this->request->getPost();
        $input['title'] = trim((string) ($input['title'] ?? ''));
        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'permit_empty|in_list[pending,completed]',
        ];
        if (! $this->validateData($input, $rules)) {
            return null;
        }

        $data = $this->validator->getValidated();
        return [
            'title' => trim($data['title']),
            'task_date' => $data['task_date'],
            'status' => ($data['status'] ?? '') ?: 'pending',
        ];
    }
}
