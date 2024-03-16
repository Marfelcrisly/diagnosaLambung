<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use App\Models\ModelUsers;
use App\Models\ModelPasien;

class Home extends BaseController
{

    protected $auth, $modelUsers, $modelPasien;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');

        $this->modelUsers = new ModelUsers();
        $this->modelPasien = new ModelPasien();
    }
    public function index()
    {
        return view('home/dashboard');
    }

    public function login()
    {
        $rules = [
            'login'    => 'required',
            'password' => 'required',
        ];
        if ($this->config->validFields === ['email']) {
            $rules['login'] .= '|valid_email';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Determine credential type
        $type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Try to log them in...
        if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember)) {
            return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
        }

        // Is the user being forced to reset their password?
        if ($this->auth->user()->force_pass_reset === true) {
            return redirect()->to(route_to('reset-password') . '?token=' . $this->auth->user()->reset_hash)->withCookies();
        }

        $redirectURL = session('redirect_url') ?? site_url('/');
        unset($_SESSION['redirect_url']);

        return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
    }

    public function daftar_users()
    {
        $users= $this->modelUsers->getUsers()->findAll();
        
        $data = [
            'title' => 'Management Users',
            'data'  => $users
        ];

        return view('home/daftar_users', $data);
    }

    public function daftar_pasien()
    {
        $pasien = $this->modelPasien->getPasien()->findAll();
        
        $data = [
            'title' => 'Management Pasien',
            'data'  => $pasien
        ];

        return view('home/daftar_pasien', $data);
    }

    public function hapus_pasien($id) 
    {
        $this->modelPasien->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Transaksi berhasil dihapus');
        return redirect()->to('daftar_pasien');
    }

    public function tambah_pasien()
    {
        $data = [
            'title' => 'Form Tambah Pasien',
        ];

        return view('home/tambah_pasien', $data);
    }

    public function simpan_pasien()
    {
        $rules = [
            'no_rm' => [
                'rules' => 'required|is_unique[data_pasien.no_rm]',
                'errors' => [
                    'required' => 'No. RM harus diisi',
                    'is_unique' => 'No. RM sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dipilih',
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umur harus diisi',
                ]
            ],
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $no_rm = $this->request->getVar('no_rm');
        $nama = $this->request->getVar('nama');
        $jk = $this->request->getVar('jk');
        $umur = $this->request->getVar('umur');

        $data = [
            'no_rm' => $no_rm,
            'nama' => $nama,
            'jk' => $jk,
            'umur' => $umur,
        ];

        $this->modelPasien->save($data);
        session()->setFlashdata('pesan', 'Transaksi berhasil ditambah.');
        return redirect()->to('daftar_pasien');
    }

    public function edit_pasien($id)
    {
        $pasien = $this->modelPasien->getPasien()->find($id);
        $data = [
            'title' => 'Form Edit Pasien',
            'pasien' => $pasien
        ];

        return view('home/edit_pasien', $data);
    }

    public function ubah_pasien($id)
    {
        
    }
}
