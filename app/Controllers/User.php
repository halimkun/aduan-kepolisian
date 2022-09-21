<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as EntitiesUser;

class User extends BaseController
{
    protected $user;
    protected $config;

    public function __construct()
    {
        $this->user = new \App\Models\UserModel();
        $this->config = config('Auth');
    }

    public function index()
    {
        return redirect()->to(base_url('/admin/user'));
    }

    public function getById()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('/admin/user'));
        } else {
            $id = $this->request->getVar('id');

            if ($this->user->find($id) !== null) {
                return $this->response->setJSON([ 'status' => 'success','data' => $this->user->select([
                    'jenis_kelamin', 'tanggal_lahir', 'pekerjaan', 'alamat', 'username', 'email', 'nama', 'id'
                ])->find($id)]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
            }
        }
    }

    public function store()
    {
        if (!$this->request->getMethod() == 'post') {
            return redirect()->to(base_url('/admin/user'));
        } else {
            $data = new EntitiesUser([
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tanggal_lahir' => $this->request->getPost('tglLahir'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'alamat' => $this->request->getPost('alamat'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),

                'active' => 1,
                'password' => date('dmY', strtotime($this->request->getPost('tglLahir'))),
            ]);

            if ($this->user->withGroup($this->config->defaultUserGroup)->insert($data)) {                
                session()->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->to(base_url('admin/user'));
            } else {
                session()->setFlashdata('error', 'Data gagal disimpan');
                return redirect()->to(base_url('admin/user'))->with('errors', $this->user->errors());
            }
        }
    }

    public function update()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'id' => $this->request->getPost('user_detail'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tanggal_lahir' => $this->request->getPost('tglLahir'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'alamat' => $this->request->getPost('alamat'),
                'email' => $this->request->getPost('email'),
            ];

            if ($this->user->save($data)) {
                session()->setFlashdata('success', 'Data berhasil diupdate');
                return redirect()->to(base_url('admin/user'));
            } else {
                session()->setFlashdata('error', 'Data gagal diupdate');
                return redirect()->to(base_url('admin/user'));
            }
        } else {
            return redirect()->to(base_url('/admin/user'));
        }
    }

    public function updatePass() {
        if ($this->request->getMethod() == 'post') {
            $data = new EntitiesUser([
                'id' => $this->request->getPost('user_detail'),
                'password' => $this->request->getPost('np'),
            ]);

            if ($this->user->save($data)) {
                session()->setFlashdata('success', 'Data berhasil diupdate');
                return redirect()->to(base_url('admin/user'));
            } else {
                session()->setFlashdata('error', 'Data gagal diupdate');
                return redirect()->to(base_url('admin/user'));
            }
        } else {
            return redirect()->to(base_url('/admin/user'));
        }
    }

    // hapus data user
    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            if ($this->user->delete($id)) {
                return redirect()->to(base_url('admin/user'));
            } else {
                return redirect()->to(base_url('admin/user'));
            }
        } else {
            return redirect()->to(base_url('/admin/user'));
        }
    }
}
