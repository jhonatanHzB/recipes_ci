<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'example' => 'example'
        ];

        return view('welcome_message', $data);
    }
}
