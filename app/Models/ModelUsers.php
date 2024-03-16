<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsers extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['email', 'username', 'password_hash'];

    public function getUsers()
    {
        $query = $this->table('users')->select('email, username, password_hash');

        return $query;
    }
}