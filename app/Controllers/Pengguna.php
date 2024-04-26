<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelUsers;
use CodeIgniter\HTTP\RequestTrait;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Pengguna extends BaseController
{
    use RequestTrait;

    /**
     * @var AuthConfig
     */
    protected $config;

    protected $modelUsers, $db;

    public function __construct()
    {

        $this->config = config('Auth');

        $this->modelUsers = new ModelUsers();
        $this->db = \Config\Database::connect();
    }

    public function daftar_pengguna()
    {
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $pengguna = $this->modelUsers->select('users.id, email, username, password_hash, auth_groups.description as role, users.jk')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->orderBy('username', 'asc');

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pengguna = $pengguna->like('username', $keyword)->orLike('email', $keyword)->orLike('users.name', $keyword)->orLike('jk', $keyword);
        }

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $pengguna->paginate($page, 'users', $currentPage);

        $data = [
            'title' => 'Data Pengguna',
            'data'  => $data,
            'pager'      => $this->modelUsers->pager,
            'currentPage' => $currentPage,
            'page'       => $page,
            'keyword'   => $keyword
        ];

        return view('pengguna/daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $role = $this->db->table('auth_groups')->select('id, name, description')->get()->getResultArray();
        $data = [
            'title' => 'Form Tambah Pengguna',
            'role'  => $role
        ];

        return view('pengguna/tambah_pengguna', $data);
    }

    public function simpan_pengguna()
    {
        $users = model(UserModel::class);

        $rules = [
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah ada'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi',
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Repeat password harus diisi',
                    'matches[password]' => 'Repeat password harus strong',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        $userGroup = $this->request->getVar('role');

        if (!empty($userGroup)) {
            $users = $users->withGroup($userGroup);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_pengguna');
    }

    public function hapus_pengguna($id = null)
    {
        $this->modelUsers->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_pengguna');
    }

    public function reset_password($id = null)
    {
        $user = new User();
        $password = '12345678';

        $user->setPassword($password);

        $hashedPassword = $user->password_hash;

        $data = [
            'id' => $id,
            'password_hash' => $hashedPassword
        ];

        $this->modelUsers->save($data);
        session()->setFlashdata('pesan', 'Password berhasil direset.');
        return redirect()->to('daftar_pengguna');
    }
}
