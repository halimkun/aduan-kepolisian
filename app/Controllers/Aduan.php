<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Aduan extends BaseController
{
    protected $aduan;

    public function __construct()
    {
        $this->aduan = new \App\Models\AduanModel();
    }

    public function index()
    {
        return redirect()->to(base_url('admin/aduan'));
    }

    public function create()
    {
        d($this->request->getFile('foto_aduan'));

        $bukti = $this->request->getFile('foto_aduan');
        $bukti_file_name = $bukti->getRandomName();

        // upload file
        $bukti->move('foto_kejadian', $bukti_file_name);

        $data = [
            'user_id' => $this->request->getPost('users'),
            'nomor' => rand(10000000, 99999999),
            'status' => 'belum diproses',
            'tanggal' => $this->request->getPost('tanggal_kejadian'),
            'jenis' => $this->request->getPost('jenis_aduan'),
            'judul' => $this->request->getPost('judul'),
            'lokasi' => $this->request->getPost('lokasi'),
            'keterangan' => $this->request->getPost('keterangan'),
            'foto' => $bukti_file_name,
        ];

        if ($this->aduan->save($data)) {
            session()->setFlashdata('success', 'Aduan berhasil ditambahkan');
            return redirect()->to(base_url('admin/aduan'));
        } else {
            session()->setFlashdata('error', 'Aduan Gagal ditambahkan, nampaknya ada yang salah.');
            return redirect()->to(base_url('admin/aduan'));
        }
    }

    public function update_stts()
    {
        // method is not post
        if($this->request->getMethod() == 'post') {
            if ($this->aduan->save([
                'id' => $this->request->getPost('data'),
                'status' => $this->request->getPost('status'),
            ])) {
                session()->setFlashdata('success', 'Status aduan berhasil diubah');
                return redirect()->to(base_url('admin/aduan'));
            } else {
                session()->setFlashdata('error', 'Status aduan gagal diubah, nampaknya ada yang salah.');
                return redirect()->to(base_url('admin/aduan'));
            }
        } else {
            return redirect()->to(base_url('admin/aduan'));
        }
    }

    public function getById()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('/admin/aduan'));
        } else {
            $id = $this->request->getVar('id');

            if ($this->aduan->find($id) !== null) {
                return $this->response->setJSON(['status' => 'success', 'data' => $this->aduan->select([
                    'nomor', 'status', 'tanggal', 'jenis', 'judul', 'lokasi', 'keterangan', 'foto'
                ])->find($id)]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found']);
            }
        }
    }
}
