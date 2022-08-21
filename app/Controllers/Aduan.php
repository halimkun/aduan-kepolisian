<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Aduan extends BaseController
{
    protected $aduan;
    protected $user;

    public function __construct() {
        $this->aduan = new \App\Models\AduanModel;
        $this->user = new \App\Models\UserModel;
    }

    public function index()
    {
        return redirect()->to(base_url('/admin/aduan'));
    }
}
