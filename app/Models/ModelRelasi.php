<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRelasi extends Model
{
    protected $table            = 'relasi_gp';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pyk_id', 'gjl_id'];

    public function getRelasi()
    {
        $query = $this->table('relasi_gp')->select('id, pyk_id, gjl_id');

        return $query;
    }
}
