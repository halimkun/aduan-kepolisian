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

    public function aduan()
    {
        return view('aduan', [
            'segments' => $this->request->uri->getSegments(),
            'users' => $this->user->findAll()
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

    // get all user
    public function user_show()
    {
        return $this->response->setJSON(
            $this->user->select(
                [
                    'nama',
                    'username',
                    'email',
                    'jenis_kelamin',
                    'pekerjaan',
                    'alamat',
                    'tanggal_lahir'
                ]
            )->findAll()
        );
    }
}
