<?php

namespace App\Controllers;

use App\Models\ModelUsers;

class Home extends BaseController
{

    protected $modelUsers;

    public function __construct()
    {
        $this->modelUsers = new ModelUsers();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('home/dashboard', $data);
    }

    public function daftar_users()
    {
        $users = $this->modelUsers->getUsers()->findAll();

        $data = [
            'title' => 'Manajemen Pengguna',
            'data'  => $users
        ];

        return view('home/daftar_users', $data);
    }
}
