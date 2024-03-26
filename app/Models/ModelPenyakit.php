<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyakit extends Model
{
    protected $table            = 'data_penyakit';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode', 'nama', 'deskripsi', 'perawatan', 'img'];

    public function getPenyakit()
    {
        $query = $this->table('data_penyakit')->select('id, kode, nama, deskripsi, perawatan, img');

        return $query;
    }
}
