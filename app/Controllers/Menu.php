<?php

namespace App\Controllers;

use App\Models\ModelMenu;

class Menu extends BaseController
{

    protected $modelMenu;



    public function __construct()
    {
        $this->modelMenu = new ModelMenu();
    }


    public function daftar_menu()
    {
        $menu = $this->modelMenu->getMenu()->orderBy('name', 'asc')->findAll();

        $data = [
            'title' => 'Manajemen Menu',
            'data'  => $menu
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

    public function edit_menu($id)
    {
        $menu = $this->modelMenu->getMenu()->find($id);

        $data = [
            'title' => 'Form Edit Menu',
            'data' => $menu
        ];

        return view('menu/edit_menu', $data);
    }

    public function perbarui_menu($id)
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

    public function hapus_menu($id)
    {
        $this->modelMenu->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_menu');
    }

    public function status($id)
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
