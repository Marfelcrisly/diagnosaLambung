<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasusLama extends Model
{
    protected $table            = 'data_kasuslama';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'penyakit_id', 'gejala', 'bobot'];

    public function getKasusLama()
    {
        $query = $this->table('data_kasuslama')->select('id, penyakit_id, gejala, bobot');

        return $query;
    }
}
