<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'POS Home',
        ];

        return view('pages/home', $data);
    }

    public function about(): string
    {
        $data = [
            'title' => 'About',
        ];

        return view('pages/about', $data);
    }
}