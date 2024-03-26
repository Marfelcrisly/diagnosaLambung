<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsers extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['email', 'username', 'password_hash', 'name', 'no_rm', 'jk', 'umur'];

    public function getUsers()
    {
        $query = $this->table('users')->select('id, email, username, password_hash, name, no_rm, jk, umur');

        return $query;
    }
}
