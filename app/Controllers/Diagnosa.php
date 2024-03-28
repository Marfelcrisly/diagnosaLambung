<?php

namespace App\Controllers;

use App\Models\ModelDiagnosa;
use App\Models\ModelUsers;
use App\Models\ModelGejala;
use App\Models\ModelPenyakit;
use App\Models\ModelRelasi;

class Diagnosa extends BaseController
{
    protected $modelDiagnosa, $modelPasien, $modelGejala, $modelPenyakit, $modelRelasi;

    public function __construct()
    {
        $this->modelDiagnosa = new ModelDiagnosa();
        $this->modelPasien = new ModelUsers();
        $this->modelGejala = new ModelGejala();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelRelasi = new ModelRelasi();
    }

    public function daftar_diagnosa()
    {
        $currentPage = $this->request->getVar('page_diagnosa') ? $this->request->getVar('page_diagnosa') : 1;

        $query = $this->modelDiagnosa->select('hasil_diagnosa.id, users.name as nama_pasien, data_penyakit.nama as nama_penyakit, kesamaan, tanggal')
            ->join('users', 'users.id = hasil_diagnosa.pasien_id', 'left')
            ->join('data_penyakit', 'data_penyakit.id = hasil_diagnosa.penyakit_id', 'left');

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $query->paginate($page, 'diagnosa', $currentPage);

        $data = [
            'title' => 'Data Diagnosa',
            'data'  => $data,
            'pager'      => $this->modelDiagnosa->pager,
            'currentPage' => $currentPage,
            'page'       => $page,
        ];

        return view('diagnosa/daftar_diagnosa', $data);
    }

    public function tambah_diagnosa()
    {
        $namaPasien = $this->modelPasien->select('users.id, username, no_rm, users.name, jk, umur')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name', 'pasien')
            ->findAll();
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

        $pasien_id = $this->request->getVar('pasien_id');
        $gejalaPasien = $this->request->getVar('diagnosa');

        $umurPasien = $this->modelPasien->getUsers()->find($pasien_id)['umur'];

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

            if ($umurPasien > 60) {
                $similarity -= 0.1;
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
            'pasien_id' => $pasien_id,
            'penyakit_id' => $diagnosa['penyakit_id'],
            'kesamaan' => $diagnosa['similarity'],
            'tanggal' => $this->request->getVar('tanggal')
        ];

        $this->modelDiagnosa->save($dataDiagnosa);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_diagnosa');
    }

    public function hapus_diagnosa($id)
    {
        $this->modelDiagnosa->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_diagnosa');
    }
}
