<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelUsers;
use App\Models\ModelGejala;
use App\Models\ModelPenyakit;
use App\Models\ModelMenu;
use App\Models\ModelBobot;
use App\Models\ModelRelasi;
use App\Models\ModelKasusLama;
use App\Models\ModelDiagnosa;
use App\Models\ModelAksesMenu;
use Myth\Auth\Entities\User;

class Home extends BaseController
{
    use ResponseTrait;

    protected $modelUsers, $modelGejala, $modelMenu, $modelPenyakit, $modelBobot, $modelRelasi, $modelKasusLama, $modelDiagnosa, $modelAksesMenu;

    public function __construct()
    {
        $this->modelUsers = new ModelUsers();
        $this->modelGejala = new ModelGejala();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelMenu = new ModelMenu();
        $this->modelBobot = new ModelBobot();
        $this->modelRelasi = new ModelRelasi();
        $this->modelKasusLama = new ModelKasusLama();
        $this->modelDiagnosa = new ModelDiagnosa();
        $this->modelAksesMenu = new ModelAksesMenu();
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

        $menu = $this->modelMenu->getMenu()->findAll();
        $jumlahData = [];

        foreach ($menu as $m) {
            if ($m['name'] == 'Data Pengguna') {
                $jumlahData[$m['name']] = $this->modelUsers->countAll();
            } elseif ($m['name'] == 'Data Pasien') {
                $jumlahData[$m['name']] = $this->modelUsers->getUsersRole()->where('auth_groups.name', 'pasien')->countAllResults();
            } elseif ($m['name'] == 'Data Gejala') {
                $jumlahData[$m['name']] = $this->modelGejala->countAll();
            } elseif ($m['name'] == 'Data Penyakit') {
                $jumlahData[$m['name']] = $this->modelPenyakit->countAll();
            } elseif ($m['name'] == 'Data Menu') {
                $jumlahData[$m['name']] = $this->modelMenu->countAll();
            } elseif ($m['name'] == 'Data Aturan') {
                $jumlahData[$m['name']] = $this->modelRelasi->countAll();
            } elseif ($m['name'] == 'Data Bobot') {
                $jumlahData[$m['name']] = $this->modelBobot->countAll();
            } elseif ($m['name'] == 'Data Kasus Baru') {
                $jumlahData[$m['name']] = $this->modelDiagnosa->countAll();
            } elseif ($m['name'] == 'Data Akses Menu') {
                $jumlahData[$m['name']] = $this->modelAksesMenu->countAll();
            } elseif ($m['name'] == 'Data Kasus Lama') {
                $jumlahData[$m['name']] = $this->modelKasusLama->countAll();
            }
        }

        $data['namaGejala'] = $namaGejala;

        $data['menu'] = $menu;

        $data['jumlahData'] = $jumlahData;

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
