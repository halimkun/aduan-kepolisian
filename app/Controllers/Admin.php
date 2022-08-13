<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/home');
    }

    public function user()
    {
        return view('admin/user');
    }
}
