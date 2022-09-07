<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $userModel;
    protected $aduanModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->aduanModel = new \App\Models\AduanModel();
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
            'users' => $this->userModel->findAll(),
            'aduan' => $this->aduanModel->findAll()
        ]);
    }

    public function user()
    {
        $data = [
            'title' => 'User',
            'segments' => $this->request->uri->getSegments(),
            'users' => $this->userModel->findAll(),
        ];

        return view('user', $data);
    }

    public function user_show()
    {
        return $this->response->setJSON(
            $this->userModel->select(
                [
                    'nama','username','email',
                    'jenis_kelamin','pekerjaan',
                    'alamat','tanggal_lahir'
                ]
            )->findAll()
        );
    }
}
