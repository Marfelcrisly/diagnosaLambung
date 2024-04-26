<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelMenu;
use App\Models\ModelAksesMenu;

class Menu extends BaseController
{
    use ResponseTrait;

    protected $modelMenu, $modelAksesMenu, $db;

    public function __construct()
    {
        $this->modelMenu = new ModelMenu();
        $this->modelAksesMenu = new ModelAksesMenu();

        $this->db = \Config\Database::connect();
    }


    public function daftar_menu()
    {
        $currentPage = $this->request->getVar('page_menu') ? $this->request->getVar('page_menu') : 1;
        $menu = $this->modelMenu->getMenu()->orderBy('name', 'asc');

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $menu = $menu->like('name', $keyword);
        }

        $role = $this->db->table('auth_groups')->select('*')->get()->getResultArray();

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $menu->paginate($page, 'menu', $currentPage);

        $data = [
            'title' => 'Data Menu',
            'data'  => $data,
            'role'  => $role,
            'pager'      => $this->modelMenu->pager,
            'currentPage' => $currentPage,
            'page'       => $page,
            'keyword'   => $keyword
        ];

        return view('menu/daftar_menu', $data);
    }

    public function tambah_menu()
    {
        $data = [
            'title' => 'Form Tambah Menu',
        ];

        return view('menu/tambah_menu', $data);
    }

    public function simpan_menu()
    {
        $rules = [
            'name' => [
                'rules' => 'required|is_unique[auth_permissions.name]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'is_unique' => 'Nama sudah ada'
                ]
            ],
            'url' => [
                'rules' => 'required|is_unique[auth_permissions.url]',
                'errors' => [
                    'required' => 'Url harus diisi',
                    'is_unique' => 'Url sudah ada'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getVar('name');
        $url = $this->request->getVar('url');
        $icon = $this->request->getVar('icon');

        $data = [
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
        ];

        $this->modelMenu->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_menu');
    }

    public function edit_menu($id = null)
    {
        $menu = $this->modelMenu->getMenu()->find($id);

        $data = [
            'title' => 'Form Edit Menu',
            'data' => $menu
        ];

        return view('menu/edit_menu', $data);
    }

    public function perbarui_menu($id = null)
    {
        $rules = [
            'name' => [
                'rules' => 'required|is_unique[auth_permissions.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'is_unique' => 'Nama sudah ada'
                ]
            ],
            'url' => [
                'rules' => 'required|is_unique[auth_permissions.url,id,' . $id . ']',
                'errors' => [
                    'required' => 'Url harus diisi',
                    'is_unique' => 'Url sudah ada'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getVar('name');
        $url = $this->request->getVar('url');
        $icon = $this->request->getVar('icon');

        $data = [
            'id' => $id,
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
        ];

        $this->modelMenu->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_menu');
    }

    public function hapus_menu($id = null)
    {
        $this->modelMenu->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_menu');
    }

    public function status($id = null)
    {
        $status = $this->request->getVar('status');

        $data = [
            'id' => $id,
            'status' => $status
        ];

        $this->modelMenu->save($data);
        return redirect()->to('daftar_menu');
    }
}
