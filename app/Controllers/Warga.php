<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;
use App\Entities\User as EntitiesUser;

class Warga extends BaseController
{
    protected $tmbhAduan;
    protected $informasi;
    protected $jenisModel;
    protected $statusModel;

    protected $userModel;
    protected $aduanModel;

    protected $profileLengkap;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->aduanModel = new \App\Models\AduanModel();

        $this->jenisModel = new \App\Models\JenisModel();
        $this->statusModel = new \App\Models\StatusModel();

        $route = Services::routes();
        $this->tmbhAduan = array_key_exists('admin/aduan/add', $route->getRoutes());
        $this->informasi = array_key_exists('admin/informasi', $route->getRoutes());

        $this->profileLengkap = $this->userModel->isProfileComplete(user_id());
    }

    public function index()
    {
        return view('warga/index', [
            'segments' => $this->request->uri->getSegments(),

            'aduan' => $this->aduanModel->where('user_id', user_id())->orderBy('tanggal', "DESC")->findAll(),
            'tahun' => $this->aduanModel->select('YEAR(tanggal) as tahun')->where('user_id', user_id())->groupBy('YEAR(tanggal)')->orderBy('YEAR(tanggal)', 'DESC')->findAll(),
            'profile_lengkap' => $this->profileLengkap,

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,

            'jenis' => $this->jenisModel->findAll(),
            'status' => $this->statusModel->findAll(),
        ]);
    }

    public function aduan()
    {
        return view('warga/aduan', [
            'segments' => $this->request->uri->getSegments(),
            'agent' => $this->request->getUserAgent(),

            'aduan' => $this->aduanModel->where('user_id', user_id())->orderBy('tanggal', "DESC")->findAll(),
            'profile_lengkap' => $this->profileLengkap,

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,

            'jenis' => $this->jenisModel->findAll(),
            'status' => $this->statusModel->findAll(),
        ]);
    }

    public function aduan_add()
    {
        return view('warga/aduan_add', [
            'segments' => $this->request->uri->getSegments(),
            'agent' => $this->request->getUserAgent(),

            'aduan' => $this->aduanModel->where('user_id', user_id())->orderBy('tanggal', "DESC")->findAll(),
            'profile_lengkap' => $this->profileLengkap,

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,

            'jenis' => $this->jenisModel->findAll(),    
            'status' => $this->statusModel->findAll(),
        ]);
    }

    public function aduan_store()
    {

        // if profile belum lengkap
        if (!$this->profileLengkap) {
            session()->setFlashdata('error', 'Profile belum lengkap, silahkan lengkapi profile terlebih dahulu.');
            return redirect()->to(base_url('warga/aduan'));
        }

        $bukti = $this->request->getFile('foto_aduan');
        $bukti_file_name = $bukti->getRandomName();

        $data = [
            'user_id' => user_id(),
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

        if ($this->aduanModel->save($data)) {
            $bukti->move('foto_kejadian', $bukti_file_name);

            session()->setFlashdata('success', 'Aduan berhasil ditambahkan');
            return redirect()->to(base_url('warga/aduan'));
        } else {
            session()->setFlashdata('error', 'Aduan Gagal ditambahkan, nampaknya ada yang salah.');
            return redirect()->to(base_url('warga/aduan'));
        }
    }

    public function aduan_edit($num)
    {   
        // if profile belum lengkap
        if (!$this->profileLengkap) {
            session()->setFlashdata('error', 'Profile belum lengkap, silahkan lengkapi profile terlebih dahulu.');
            return redirect()->to(base_url('warga/aduan'));
        }

        $ad = $this->aduanModel->where(['user_id' => user_id(), 'nomor' => $num])->first();
        if (!$ad) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('warga/aduan_edit', [
            'segments' => $this->request->uri->getSegments(),
            'agent' => $this->request->getUserAgent(),

            'aduan' => $this->aduanModel->where(['user_id' => user_id(), 'nomor' => $num])->first(),

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,

            'jenis' => $this->jenisModel->findAll(),
        ]);
    }

    public function aduan_update()
    {

        // if profile belum lengkap
        if (!$this->profileLengkap) {
            session()->setFlashdata('error', 'Profile belum lengkap, silahkan lengkapi profile terlebih dahulu.');
            return redirect()->to(base_url('warga/aduan'));
        }

        $foto = $this->request->getFile('foto_aduan');
        if ($foto->getError() == 4) {
            $bukti_file_name = $this->request->getPost('foto');
        } else {
            $bukti_file_name = $foto->getRandomName();
        }

        $data = [
            'nomor' => $this->request->getPost('nomor_aduan'),
            'tanggal' => $this->request->getPost('tanggal_kejadian'),
            'jenis' => $this->request->getPost('jenis_aduan'),
            'judul' => $this->request->getPost('judul'),
            'lokasi' => $this->request->getPost('lokasi'),
            'latlang' => $this->request->getPost('latlang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'foto' => $bukti_file_name,
        ];

        // get id from nomor
        $id = $this->aduanModel->select('id')->where('nomor', $this->request->getPost('nomor_aduan'))->first();
        
        if ($this->aduanModel->update($id->id, $data)) {
            if ($foto->getError() == 0) {
                // if file exist unlink
                if (file_exists('foto_kejadian/' . $this->request->getPost('foto'))) {
                    unlink('foto_kejadian/' . $this->request->getPost('foto'));
                }
                $foto->move('foto_kejadian', $bukti_file_name);
            }

            session()->setFlashdata('success', 'Aduan berhasil diubah');
            return redirect()->to(base_url('warga/aduan'));
        } else {
            session()->setFlashdata('error', 'Aduan Gagal diubah, nampaknya ada yang salah.');
            return redirect()->to(base_url('warga/aduan'));
        }
    }

    public function aduan_delete()
    {

        // if profile belum lengkap
        if (!$this->profileLengkap) {
            session()->setFlashdata('error', 'Profile belum lengkap, silahkan lengkapi profile terlebih dahulu.');
            return redirect()->to(base_url('warga/aduan'));
        }

        // get post nomor
        $nomor = $this->request->getPost('nomor');
        $id = $this->aduanModel->select('id')->where('nomor', $nomor)->first();

        if ($this->aduanModel->delete($id->id)) {
            // return json
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Aduan berhasil dihapus',
            ]);
        } else {
            // return json
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Aduan gagal dihapus',
            ]);
        }
    }

    public function profile()
    {
        return view('warga/profile', [
            'segments' => $this->request->uri->getSegments(),
            'me' => $this->userModel->find(user_id()),

            'aduanku' => $this->aduanModel->where('user_id', user_id())->findAll(),
            'aduanku_terbaru' => $this->aduanModel->where(['user_id' => user_id()])->orderBy('tanggal', 'DESC')->findAll(3),
            'aduan_terbaru' => $this->aduanModel->where(['DATE(tanggal)' => date('Y-m-d'), 'user_id' => user_id()])->findAll(),
            'profile_lengkap' => $this->profileLengkap,

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,
        ]);
    }

    public function profile_update()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'id' => user_id(),
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nomor_hp' => $this->request->getPost('nomorHp'),
                'tempat_lahir' => $this->request->getPost('tempatLahir'),
                'tanggal_lahir' => $this->request->getPost('tglLahir'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'agama' => $this->request->getPost('agama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
            ];

            if ($this->userModel->save($data)) {
                session()->setFlashdata('success', 'Data berhasil diupdate');
                return redirect()->to(base_url('warga/profile'));
            } else {
                session()->setFlashdata('error', 'Data gagal diupdate');
                return redirect()->to(base_url('warga/profile'));
            }
        } else {
            return redirect()->to(base_url('warga/profile'));
        }
    }

    public function updatePass()
    {
        if ($this->request->getMethod() == 'post') {
            $data = new EntitiesUser([
                'id' => user_id(),
                'password' => $this->request->getPost('password'),
            ]);

            if ($this->userModel->save($data)) {
                session()->setFlashdata('success', 'Data berhasil diupdate');
                return redirect()->to(base_url('warga/profile'));
            } else {
                session()->setFlashdata('error', 'Data gagal diupdate');
                return redirect()->to(base_url('warga/profile'));
            }
        } else {
            return redirect()->to(base_url('warga/profile'));
        }
    }
}
