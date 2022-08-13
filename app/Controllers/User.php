<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'segments' => $this->request->uri->getSegments(),
            'users' => $this->user->findAll(),
        ];

        return view('user/home', $data);
    }
}
