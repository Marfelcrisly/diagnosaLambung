<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGejala extends Model
{
    protected $table            = 'data_gejala';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode', 'nama', 'deskripsi'];

    public function getGejala()
    {
        $query = $this->table('data_gejala')->select('id, kode, nama, deskripsi');

        return $query;
    }
}
