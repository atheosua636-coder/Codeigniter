<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Users extends BaseController
{
    public function index(): string
    {
        $users = (new UserModel())->orderBy('id', 'ASC')->findAll();

        foreach ($users as &$user) {
            $avatar = basename((string) ($user['avatar'] ?? ''));
            $avatarPath = FCPATH . 'uploads/avatars/' . $avatar;
            $user['avatar_url'] = $avatar !== '' && is_file($avatarPath)
                ? base_url('uploads/avatars/' . rawurlencode($avatar))
                : base_url('images/avatar-placeholder.svg');
        }
        unset($user);

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }

    public function newForm(): string
    {
        return view('users/form', [
            'title' => 'Add User',
            'heading' => 'Add User',
            'user' => [],
            'action' => site_url('users/create'),
            'isEdit' => false,
        ]);
    }

    public function create(): RedirectResponse
    {
        $rules = [
            'username' => 'required|max_length[80]|is_unique[users.username]',
            'full_name' => 'required|max_length[150]',
            'password' => 'required|min_length[8]|max_length[255]',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $values = $this->validator->getValidated();
        (new UserModel())->insert([
            'username' => trim($values['username']),
            'full_name' => trim($values['full_name']),
            'password' => password_hash($values['password'], PASSWORD_DEFAULT),
            'role' => 'Staff',
            'avatar' => null,
        ]);

        return redirect()->to(site_url('users'))->with('message', 'User added.');
    }

    public function edit(int $id): string|RedirectResponse
    {
        $user = (new UserModel())->find($id);
        if ($user === null) {
            return redirect()->to(site_url('users'))->with('message', 'User not found.');
        }

        $avatar = basename((string) ($user['avatar'] ?? ''));
        $avatarPath = FCPATH . 'uploads/avatars/' . $avatar;
        $user['avatar_url'] = $avatar !== '' && is_file($avatarPath)
            ? base_url('uploads/avatars/' . rawurlencode($avatar))
            : base_url('images/avatar-placeholder.svg');

        return view('users/form', [
            'title' => 'Edit User',
            'heading' => 'Edit User',
            'user' => $user,
            'action' => site_url('users/' . $id . '/update'),
            'isEdit' => true,
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $userModel = new UserModel();
        $existingUser = $userModel->find($id);
        if ($existingUser === null) {
            return redirect()->to(site_url('users'))->with('message', 'User not found.');
        }

        $rules = [
            'username' => 'required|max_length[80]|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|max_length[150]',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $values = $this->validator->getValidated();

        $uploadedFile = $this->request->getFile('avatar');
        $hasUpload = $uploadedFile !== null && $uploadedFile->getError() !== UPLOAD_ERR_NO_FILE;
        $newAvatarName = null;

        if ($hasUpload) {
            $fileRules = [
                'avatar' => [
                    'label' => 'Avatar',
                    'rules' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]',
                ],
            ];

            if (! $this->validateData([], $fileRules)) {
                return redirect()->back()->withInput();
            }

            $extension = $uploadedFile->getMimeType() === 'image/png' ? 'png' : 'jpg';
            $newAvatarName = bin2hex(random_bytes(16)) . '.' . $extension;
            $avatarDirectory = FCPATH . 'uploads/avatars';

            if (! is_dir($avatarDirectory) && ! mkdir($avatarDirectory, 0755, true) && ! is_dir($avatarDirectory)) {
                return redirect()->back()->withInput()->with('uploadError', 'The avatar folder could not be created.');
            }

            try {
                service('image')
                    ->withFile($uploadedFile->getTempName())
                    ->fit(160, 160, 'center')
                    ->save($avatarDirectory . DIRECTORY_SEPARATOR . $newAvatarName);
            } catch (\Throwable $exception) {
                log_message('error', 'Avatar preparation failed: {message}', ['message' => $exception->getMessage()]);

                return redirect()->back()->withInput()->with('uploadError', 'The uploaded image could not be prepared.');
            }
        }

        $updateData = [
            'username' => trim($values['username']),
            'full_name' => trim($values['full_name']),
        ];
        if ($newAvatarName !== null) {
            $updateData['avatar'] = $newAvatarName;
        }

        if (! $userModel->update($id, $updateData)) {
            if ($newAvatarName !== null) {
                @unlink(FCPATH . 'uploads/avatars/' . $newAvatarName);
            }

            return redirect()->back()->withInput()->with('uploadError', 'The user could not be updated. Please try again.');
        }

        if ($newAvatarName !== null) {
            $oldAvatar = basename((string) ($existingUser['avatar'] ?? ''));
            if ($oldAvatar !== '' && is_file(FCPATH . 'uploads/avatars/' . $oldAvatar)) {
                @unlink(FCPATH . 'uploads/avatars/' . $oldAvatar);
            }
        }

        return redirect()->to(site_url('users'))->with('message', 'User updated.');
    }
}
