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
        $bukti = $this->request->getFile('foto_aduan');
        $bukti_file_name = $bukti->getRandomName();

        $data = [
            'user_id' => $this->request->getPost('users'),
            'nomor' => rand(10000000, 99999999),
            'status' => 1,
            'tanggal' => $this->request->getPost('tanggal_kejadian'),
            'jenis' => $this->request->getPost('jenis_aduan'),
            'judul' => $this->request->getPost('judul'),
            'lokasi' => $this->request->getPost('lokasi'),
            'latlang' => $this->request->getPost('latlang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'foto' => $bukti_file_name,
        ];

        if ($this->aduan->save($data)) {
            $bukti->move('foto_kejadian', $bukti_file_name);
            
            session()->setFlashdata('success', 'Aduan berhasil ditambahkan');
            return redirect()->to(base_url('admin/aduan'));
        } else {
            session()->setFlashdata('error', 'Aduan Gagal ditambahkan, nampaknya ada yang salah.');
            return redirect()->to(base_url('admin/aduan'));
        }
    }

    public function update_stts()
    {
        if ($this->request->getMethod() == 'post') {
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
            $data = $this->aduan
                ->select([
                    'aduan.id', 'aduan.user_id', 'aduan.nomor', 'aduan.status', 'aduan.tanggal', 'aduan.jenis', 'aduan.judul', 'aduan.lokasi', 'aduan.keterangan', 'aduan.foto',
                    'jenis_aduan.jenis_aduan', 'jenis_aduan.id_jenis',
                    'status_aduan.status_aduan', 'status_aduan.id_status'
                ])
                ->join('jenis_aduan', 'jenis_aduan.id_jenis = aduan.jenis')
                ->join('status_aduan', 'status_aduan.id_status = aduan.status')
                ->find($id);


            if ($data !== null) {
                return $this->response->setJSON(['status' => 'success', 'data' => $data]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found']);
            }
        }
    }

    public function getAll()
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, created_at, updated_at 
            deleted_at'
        )->orderBy('tanggal', "DESC")->findAll();

        return $aduan;
    }

    public function getLatest()
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, created_at, updated_at 
            deleted_at'
        )->orderBy('tanggal', 'DESC')->findAll(1);

        return $aduan;
    }

    public function getByNum($num)
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, created_at, updated_at 
            deleted_at'
        )->where('nomor', $num)->findAll();

        return $aduan;
    }

    public function getByJenis($jenis)
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, created_at, updated_at 
            deleted_at'
        )->orderBy('tanggal', "DESC")->where('jenis', $jenis)->findAll();

        return $aduan;
    }

    public function getByStatus($status)
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, created_at, updated_at 
            deleted_at'
        )->orderBy('tanggal', "DESC")->where('status', $status)->findAll();

        return $aduan;
    }

    public function getByYear($year)
    {
        $aduan = $this->aduan->select(
            'user_id, nomor, status, tanggal, jenis, judul, 
            lokasi, keterangan, foto, MONTH(tanggal) as bulan, created_at, updated_at 
            deleted_at'
        )->where('YEAR(tanggal)', $year)->orderBy('MONTH(tanggal)', 'ASC')->findAll();

        return $aduan;
    }

    public function chartYearly($year)
    {
        $aduan = $this->aduan->select('COUNT(*) as total, MONTH(tanggal) as bulan, YEAR(tanggal) as tahun')
            ->where('YEAR(tanggal)', $year)
            ->groupBy('MONTH(tanggal)')
            ->orderBy('MONTH(tanggal)', 'ASC')
            ->findAll();

        return $aduan;
    }
}
