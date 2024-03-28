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

    public function getUsersRole()
    {
        $query = $this->table('users')->select('auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        return $query;
    }
}
