<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRole extends Model
{
    protected $table            = 'auth_groups';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'description'];

    public function getRole()
    {
        $query = $this->table('auth_groups')->select('id, name, description');

        return $query;
    }
}
