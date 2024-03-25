<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBobot extends Model
{
    protected $table            = 'bobot';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['parameter', 'nilai'];

    public function getBobot()
    {
        $query = $this->table('bobot')->select('id, parameter, nilai');

        return $query;
    }
}
