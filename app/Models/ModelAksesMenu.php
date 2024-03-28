<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAksesMenu extends Model
{
    protected $table            = 'auth_groups_permissions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['group_id', 'permission_id'];

    public function getAksesMenu()
    {
        $query = $this->table('auth_groups_permissions')->select('auth_groups.id, auth_groups.name as namaRole, auth_permissions.name as namaMenu, status, url, icon')
            ->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id')
            ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id');

        return $query;
    }

    public function getAksesMenuByRole($roleId)
    {
        $query = $this->table('auth_groups_permissions')
            ->select('auth_groups.name as role_name, auth_permissions.name as menu_name, auth_permissions.status, auth_permissions.url, auth_permissions.icon')
            ->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id')
            ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id')
            ->where('auth_groups.id', $roleId)
            ->findAll();

        return $query;
    }
}
