<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPasien extends Model
{
    protected $table            = 'data_pasien';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['no_rm', 'nama', 'jk', 'umur'];

    public function getPasien()
    {
        $query = $this->table('data_pasien')->select('id, no_rm, nama, jk, umur');

        return $query;
    }
}