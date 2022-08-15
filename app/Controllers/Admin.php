<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new \App\Models\UserModel();
    }

    public function index()
    {
        return redirect()->to(base_url('admin/home'));
    }

    public function home()
    {
        return view('home', [
            'segments' => $this->request->uri->getSegments(),
        ]);
    }

    public function user()
    {
        $data = [
            'title' => 'User',
            'segments' => $this->request->uri->getSegments(),
            'users' => $this->user->findAll(),
        ];

        return view('user', $data);
    }
}
