<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\HTTP\RedirectResponse;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        return view('customers/index', [
            'title' => 'Customer Accounts',
            'customers' => $customerModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function newForm(): string
    {
        return view('customers/form', [
            'title' => 'Add Customer',
            'heading' => 'Add Customer',
            'customer' => [],
            'action' => site_url('customers/create'),
        ]);
    }

    public function create(): RedirectResponse
    {
        $rules = [
            'full_name' => 'required|max_length[150]',
            'email' => 'required|valid_email|max_length[254]',
            'phone' => 'permit_empty|max_length[40]',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $values = $this->validator->getValidated();
        (new CustomerModel())->insert([
            'full_name' => trim($values['full_name']),
            'email' => trim($values['email']),
            'phone' => trim($values['phone'] ?? ''),
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer added.');
    }

    public function edit(int $id): string|RedirectResponse
    {
        $customer = (new CustomerModel())->find($id);
        if ($customer === null) {
            return redirect()->to(site_url('customers'))->with('message', 'Customer not found.');
        }

        return view('customers/form', [
            'title' => 'Edit Customer',
            'heading' => 'Edit Customer',
            'customer' => $customer,
            'action' => site_url('customers/' . $id . '/update'),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $customerModel = new CustomerModel();
        if ($customerModel->find($id) === null) {
            return redirect()->to(site_url('customers'))->with('message', 'Customer not found.');
        }

        $rules = [
            'full_name' => 'required|max_length[150]',
            'email' => 'required|valid_email|max_length[254]',
            'phone' => 'permit_empty|max_length[40]',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $values = $this->validator->getValidated();
        $customerModel->update($id, [
            'full_name' => trim($values['full_name']),
            'email' => trim($values['email']),
            'phone' => trim($values['phone'] ?? ''),
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer updated.');
    }
}
