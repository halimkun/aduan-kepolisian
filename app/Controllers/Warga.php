<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Warga extends BaseController
{
    protected $tmbhAduan;
    protected $informasi;

    protected $userModel;
    protected $aduanModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->aduanModel = new \App\Models\AduanModel();

        $route = Services::routes();
        $this->tmbhAduan = array_key_exists('admin/aduan/add', $route->getRoutes());
        $this->informasi = array_key_exists('admin/informasi', $route->getRoutes());
    }

    public function index()
    {
        return view('warga/index', [
            'segments' => $this->request->uri->getSegments(),
            'tambah_aduan' => $this->tmbhAduan,
        ]);
    }

    public function aduan()
    {
        return view('warga/aduan', [
            'segments' => $this->request->uri->getSegments(),
            'agent' => $this->request->getUserAgent(),
            
            'aduan' => $this->aduanModel->where('user_id', user_id())->orderBy('tanggal', "DESC")->findAll(),
            
            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,
        ]);
    }
    
    public function aduan_add()
    {
        return view('warga/aduan_add', [
            'segments' => $this->request->uri->getSegments(),
            'agent' => $this->request->getUserAgent(),
            
            'aduan' => $this->aduanModel->where('user_id', user_id())->orderBy('tanggal', "DESC")->findAll(),
            
            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,
        ]);
    }

    public function profile()
    {
        return view('warga/profile', [
            'segments' => $this->request->uri->getSegments(),
            'me' => $this->userModel->find(user_id()),

            'aduanku' => $this->aduanModel->where('user_id', user_id())->findAll(),
            'aduanku_terbaru' => $this->aduanModel->where(['user_id' => user_id()])->orderBy('tanggal', 'DESC')->findAll(3),
            'aduan_terbaru' => $this->aduanModel->where(['DATE(tanggal)' => date('Y-m-d'), 'user_id' => user_id()])->findAll(),

            'tambah_aduan' => $this->tmbhAduan,
            'informasi' => $this->informasi,
        ]);
    }
}
