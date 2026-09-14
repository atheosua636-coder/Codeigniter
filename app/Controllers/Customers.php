<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            [
                'full_name' => 'Juan Dela Cruz',
                'email'     => 'juan@example.com',
                'phone'     => '0917-123-4567',
            ],
            [
                'full_name' => 'Maria Santos',
                'email'     => 'maria@example.com',
                'phone'     => '0918-234-5678',
            ],
            [
                'full_name' => 'Carlo Reyes',
                'email'     => 'carlo@example.com',
                'phone'     => '0919-345-6789',
            ],
            [
                'full_name' => 'Angela Garcia',
                'email'     => 'angela@example.com',
                'phone'     => '0920-456-7890',
            ],
            [
                'full_name' => 'Paolo Mendoza',
                'email'     => 'paolo@example.com',
                'phone'     => '0921-567-8901',
            ],
        ];

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customers,
        ];

        return view('customers/index', $data);
    }
}