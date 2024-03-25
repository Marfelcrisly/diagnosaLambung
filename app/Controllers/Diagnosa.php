<?php

namespace App\Controllers;

use App\Models\ModelDiagnosa;
use App\Models\ModelPasien;
use App\Models\ModelGejala;
use App\Models\ModelPenyakit;
use App\Models\ModelRelasi;

class Diagnosa extends BaseController
{
    protected $modelDiagnosa, $modelPasien, $modelGejala, $modelPenyakit, $modelRelasi;



    public function __construct()
    {
        $this->modelDiagnosa = new ModelDiagnosa();
        $this->modelPasien = new ModelPasien();
        $this->modelGejala = new ModelGejala();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelRelasi = new ModelRelasi();
    }

    public function daftar_diagnosa()
    {
        $currentPage = $this->request->getVar('page_diagnosa') ? $this->request->getVar('page_diagnosa') : 1;

        $query = $this->modelDiagnosa->select('hasil_diagnosa.id, data_pasien.nama as nama_pasien, data_penyakit.nama as nama_penyakit, kesamaan, tanggal')
            ->join('data_pasien', 'data_pasien.id = hasil_diagnosa.pasien_id', 'left')
            ->join('data_penyakit', 'data_penyakit.id = hasil_diagnosa.penyakit_id', 'left');

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $query->paginate($page, 'diagnosa', $currentPage);

        $data = [
            'title' => 'Manajemen Diagnosa',
            'data'  => $data,
            'pager'      => $this->modelDiagnosa->pager,
            'currentPage' => $currentPage,
            'page'       => $page,
        ];

        return view('diagnosa/daftar_diagnosa', $data);
    }

    public function tambah_diagnosa()
    {
        $namaPasien = $this->modelPasien->getPasien()->findAll();
        $namaGejala = $this->modelGejala->getGejala()->findAll();

        $data = [
            'title' => 'Form Tambah Diagnosa',
            'namaPasien' => $namaPasien,
            'namaGejala' => $namaGejala
        ];

        return view('diagnosa/tambah_diagnosa', $data);
    }

    public function simpan_diagnosa()
    {
        $rules = [
            'pasien_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien harus dipilih',
                ]
            ],
            'diagnosa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Salah satu harus dipilih',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gejalaPasien = $this->request->getVar('diagnosa');

        $penyakitSimilarity = [];

        $penyakitData = $this->modelPenyakit->getPenyakit()->findAll();


        foreach ($penyakitData as $penyakit) {
            $similarity = 0;
            $totalBobot = 0;

            $gejalaPenyakit = $this->modelRelasi->select('relasi_gp.id, pyk_id, gjl_id, nilai')
                ->where('pyk_id', $penyakit['id'])
                ->join('bobot', 'bobot.id = relasi_gp.bobot_id')
                ->findAll();

            foreach ($gejalaPenyakit as $gejala) {
                if (in_array($gejala['gjl_id'], $gejalaPasien)) {
                    $similarity += $gejala['nilai'];
                }
                $totalBobot += $gejala['nilai'];
            }

            if ($totalBobot > 0) {
                $similarity /= $totalBobot;
            }

            $penyakitSimilarity[] = [
                'penyakit_id' => $penyakit['id'],
                'nama' => $penyakit['nama'],
                'similarity' => $similarity
            ];
        }

        usort($penyakitSimilarity, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        $diagnosa = $penyakitSimilarity[0];

        $dataDiagnosa = [
            'pasien_id' => $this->request->getVar('pasien_id'),
            'penyakit_id' => $diagnosa['penyakit_id'],
            'kesamaan' => $diagnosa['similarity'],
            'tanggal' => $this->request->getVar('tanggal')
        ];

        $this->modelDiagnosa->save($dataDiagnosa);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_diagnosa');
    }
}
