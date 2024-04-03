<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDiagnosa extends Model
{
    protected $table            = 'hasil_diagnosa';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pasien_id', 'penyakit_id', 'kesamaan', 'tanggal', 'gejala', 'persenan', 'kriteria'];

    public function getDiagnosa()
    {
        $query = $this->table('hasil_diagnosa')->select('pasien_id, penyakit_id, kesamaan, tanggal, persenan, kriteria');

        return $query;
    }
}
