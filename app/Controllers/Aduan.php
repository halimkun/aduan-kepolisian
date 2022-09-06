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
            'nomor' => rand(100000, 999999),
            'status' => 'pending',
            'tanggal'=> $this->request->getPost('tanggal_kejadian'),
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
}
