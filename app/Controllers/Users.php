<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            [
                'username'  => 'admin01',
                'full_name' => 'Atheo Sua',
                'role'      => 'Administrator',
            ],
            [
                'username'  => 'cashier01',
                'full_name' => 'Jamie Cruz',
                'role'      => 'Cashier',
            ],
            [
                'username'  => 'cashier02',
                'full_name' => 'Nicole Reyes',
                'role'      => 'Cashier',
            ],
            [
                'username'  => 'manager01',
                'full_name' => 'Mark Santos',
                'role'      => 'Manager',
            ],
            [
                'username'  => 'staff01',
                'full_name' => 'Anne Garcia',
                'role'      => 'Staff',
            ],
        ];

        $data = [
            'title' => 'User Accounts',
            'users' => $users,
        ];

        return view('users/index', $data);
    }
}