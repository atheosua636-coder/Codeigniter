<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            return redirect()->to(site_url('customers'));
        }

        return view('auth/login', ['title' => 'Staff Login']);
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
        $user = (new UserModel())
            ->where('username', trim($values['username']))
            ->first();

        if (
            $user !== null
            && ! empty($user['password'])
            && password_verify($values['password'], $user['password'])
        ) {
            session()->regenerate();
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => true,
            ]);

            return redirect()->to(site_url('customers'));
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid username or password.');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to(site_url('login'))
            ->with('message', 'You have been logged out.');
    }
}
