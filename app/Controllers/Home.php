<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelUsers;
use App\Models\ModelGejala;
use Myth\Auth\Entities\User;

class Home extends BaseController
{
    use ResponseTrait;

    protected $modelUsers, $modelGejala;

    public function __construct()
    {
        $this->modelUsers = new ModelUsers();
        $this->modelGejala = new ModelGejala();
    }
    public function index()
    {
        $pengguna = $this->modelUsers->select('auth_groups.description as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', user()->id)
            ->first()['role'];

        $namaGejala = $this->modelGejala->getGejala()->findAll();

        if ($pengguna === 'Admin') {
            $data['title'] = 'Dashboard';
        } else {
            $data = [
                'title' => 'Isi Form Diagnosa',
            ];
        }
        $data['namaGejala'] = $namaGejala;
        return view('home/dashboard', $data);
    }

    public function profile()
    {
        $query = $this->modelUsers->select('users.id, email, username, password_hash, auth_groups.description as role, users.name')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', user()->id)
            ->first();

        $data = [
            'title' => 'Data Pribadi',
            'data'  => $query
        ];
        return view('home/profile', $data);
    }

    public function perbarui_profile($id = null)
    {
        $rules = [
            'pass_confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Repeat password harus sama dengan password',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $name = $this->request->getVar('nama');

        $user = new User();
        $password = $this->request->getVar('password');

        if (!empty($password)) {
            $user->setPassword($password);
            $hashedPassword = $user->password_hash;
        } else {
            $existingUser = $this->modelUsers->find($id);
            $hashedPassword = $existingUser['password_hash'];
        }

        $data = [
            'id' => $id,
            'email' => $email,
            'name'  => $name,
            'password_hash' => $hashedPassword
        ];

        $this->modelUsers->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('profile');
    }
}
