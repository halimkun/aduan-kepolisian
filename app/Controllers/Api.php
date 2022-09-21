<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AduanModel;
use App\Models\UserModel;

class Api extends BaseController
{
    protected $am;
    protected $um;
    protected $ac;
    protected $uc;

    public function __construct()
    {
        $this->am = new AduanModel();
        $this->um = new UserModel();
        $this->ac = new \App\Controllers\Aduan();
        $this->uc = new \App\Controllers\User();
    }

    public function index()
    {
        return redirect()->to('/');
    }

    public function aduan()
    {
        return $this->response->setJSON([
            'code' => 200,
            'success' => false,
            'message' => 'Terjadi kesalahan, silahkan coba lagi.',
        ]);
    }

    // create new aduan
    public function aduan_create()
    {
        $bukti = $this->request->getFile('foto_aduan');
        $bukti_file_name = $bukti->getRandomName();

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

        if ($this->am->save($data)) {
            $bukti->move('foto_kejadian', $bukti_file_name);
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Aduan berhasil ditambahkan',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Aduan gagal ditambahkan, nampaknya ada yang salah.',
            ]);
        }
        
    }

    public function aduan_getall()
    {
        $aduan = $this->ac->getAll();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getlatest()
    {
        $aduan = $this->ac->getLatest();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbynum($nomor)
    {
        $aduan = $this->ac->getByNum($nomor);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbyjenis($jenis)
    {
        $aduan = $this->ac->getByJenis($jenis);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbystatus($status)
    {
        $aduan = $this->ac->getByStatus($status);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getByYear($year)
    {
        $aduan = $this->ac->getByYear($year);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_chartYearly($year)
    {
        $aduan = $this->ac->chartYearly($year);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_updatestts()
    {
        $data = $this->request->getJSON();
        $aduan = $this->am->where('nomor', $data->nomor)->first();

        if ($this->am->save([
            'id' => $aduan->id,
            'status' => $data->status,
        ])) {
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Status aduan berhasil diubah',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 200,
                'success' => false,
                'message' => 'Status aduan gagal diubah',
            ]);
        }
    }

    // delete aduan
    public function aduan_delete($nomor)
    {
        $aduan = $this->am->where('nomor', $nomor)->first();

        if ($this->am->delete($aduan->id)) {
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Aduan berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Aduan gagal dihapus',
            ]);
        }
    }
}
