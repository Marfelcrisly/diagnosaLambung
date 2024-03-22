<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    protected $table            = 'auth_permissions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'url', 'icon'];

    public function getMenu()
    {
        $query = $this->table('auth_permissions')->select('id, name, url, icon');

        return $query;
    }
}
