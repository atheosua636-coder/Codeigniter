<?php

namespace App\Controllers;

use App\Models\TaskUserModel;
use CodeIgniter\HTTP\RedirectResponse;

class TaskAuth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->get('task_logged_in')) {
            return redirect()->to(site_url('tasks-today'));
        }

        return view('auth/task_login', ['title' => 'Tasks for Today Login']);
    }

    public function attemptLogin(): RedirectResponse
    {
        $rules = [
            'username' => 'required|max_length[80]',
            'password' => 'required|max_length[255]',
        ];
        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $values = $this->validator->getValidated();
        $user = (new TaskUserModel())
            ->where('username', trim($values['username']))
            ->first();

        if (
            $user !== null
            && ! empty($user['password'])
            && password_verify($values['password'], $user['password'])
        ) {
            session()->regenerate();
            session()->set([
                'task_user_id' => $user['id'],
                'task_username' => $user['username'],
                'task_logged_in' => true,
            ]);

            return redirect()->to(site_url('tasks-today'));
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid username or password.');
    }

    public function logout(): RedirectResponse
    {
        session()->remove(['task_user_id', 'task_username', 'task_logged_in']);

        return redirect()->to(site_url('tasks/login'))
            ->with('message', 'You have been logged out of Tasks for Today.');
    }
}
