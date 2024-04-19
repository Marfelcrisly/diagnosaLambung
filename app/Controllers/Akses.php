<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelAksesMenu;
use App\Models\ModelMenu;
use App\Models\ModelRole;

class Akses extends BaseController
{
    use ResponseTrait;

    protected $modelAksesMenu, $modelMenu, $modelRole;

    public function __construct()
    {
        $this->modelAksesMenu = new ModelAksesMenu();
        $this->modelMenu = new ModelMenu();
        $this->modelRole = new ModelRole();
    }

    public function akses_menu()
    {
        $menu = $this->modelMenu->getMenu()->orderBy('name', 'asc')->findAll();

        $roles = $this->modelRole->getRole()->findAll();

        $statusMenus = [];

        foreach ($roles as $role) {
            $statusMenus[$role['name']] = $this->modelAksesMenu->getAksesMenuByRole($role['id']);
        }

        $data = [
            'title' => 'Data Akses Menu',
            'menu'  => $menu,
            'roles' => $roles,
            'statusMenus' => $statusMenus
        ];

        return view('akses/daftar_akses', $data);
    }

    public function aksi_simpan_status()
    {
        $roleId = $this->request->getVar('roleId');
        $menuId = $this->request->getVar('menuId');
        $status = $this->request->getVar('status');

        $existingAksesMenu = $this->modelAksesMenu
            ->where('group_id', $roleId)
            ->where('permission_id', $menuId)
            ->first();

        if ($status == 1) {
            if (!$existingAksesMenu) {
                $data = [
                    'group_id' => $roleId,
                    'permission_id' => $menuId
                ];
                $this->modelAksesMenu->insert($data);
            }
            // session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        } else {
            if ($existingAksesMenu) {
                $this->modelAksesMenu->delete($existingAksesMenu['id']);
            }
            // session()->setFlashdata('pesan', 'Data berhasil dihapus');
        }

        return redirect()->to('akses_menu');
    }
}
