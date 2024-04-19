<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelDiagnosa;
use App\Models\ModelUsers;
use App\Models\ModelGejala;
use App\Models\ModelPenyakit;
use App\Models\ModelRelasi;
use App\Models\ModelKasusLama;
use App\Models\ModelBobot;

class Diagnosa extends BaseController
{
    use ResponseTrait;

    protected $modelDiagnosa, $modelPasien, $modelGejala, $modelPenyakit, $modelRelasi, $modelKasusLama, $modelBobot;

    public function __construct()
    {
        $this->modelDiagnosa = new ModelDiagnosa();
        $this->modelPasien = new ModelUsers();
        $this->modelGejala = new ModelGejala();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelRelasi = new ModelRelasi();
        $this->modelKasusLama = new ModelKasusLama();
        $this->modelBobot = new ModelBobot();
    }

    public function daftar_diagnosa()
    {
        $currentPage = $this->request->getVar('page_diagnosa') ? $this->request->getVar('page_diagnosa') : 1;
        $keyword = $this->request->getVar('keyword');
        $query = $this->modelDiagnosa->select('hasil_diagnosa.id, users.name as nama_pasien, data_penyakit.nama as nama_penyakit, persenan, tanggal, kriteria')
            ->join('users', 'users.id = hasil_diagnosa.pasien_id', 'left')
            ->join('data_penyakit', 'data_penyakit.id = hasil_diagnosa.penyakit_id', 'left');

        if ($keyword) {
            $query = $query->like('users.name ', $keyword);
        }

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $query->paginate($page, 'diagnosa', $currentPage);

        $data = [
            'title' => 'Data Kasus Baru',
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
            ->orderBy('users.name', 'asc')
            ->findAll();

        $namaGejala = $this->modelGejala->getGejala()->orderBy('nama', 'asc')->findAll();

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

        $kasusLama = $this->modelKasusLama->select('penyakit_id, gejala, bobot')->findAll();
        $kasusBaru = $this->request->getVar('diagnosa');

        $jumlahNilaiSimilarity = [];
        $jumlahNilaiBobot = [];
        $persentase = [];

        foreach ($kasusLama as $i => $kasus) {
            $gejalaLama = json_decode($kasus['gejala'], true);
            $bobotLama = json_decode($kasus['bobot'], true);

            $jumlahSimilarity = 0;
            $jumlahBobot = 0;

            foreach ($gejalaLama as $j => $gejala) {
                if (in_array($gejala, $kasusBaru)) {
                    if (isset($bobotLama[$j])) {
                        $dataBobotLama = $this->modelBobot->find($bobotLama[$j]);
                        if ($dataBobotLama) {
                            $jumlahSimilarity += $dataBobotLama['nilai'];
                        }
                    }
                }

                if (isset($bobotLama[$j])) {
                    $dataBobotLama = $this->modelBobot->find($bobotLama[$j]);
                    if ($dataBobotLama) {
                        $jumlahBobot += $dataBobotLama['nilai'];
                    }
                }
            }
            $jumlahNilaiSimilarity[] = $jumlahSimilarity;
            $jumlahNilaiBobot[] = $jumlahBobot;
            
            $persentase[] = [
                'penyakit_id' => $kasus['penyakit_id'],
                'jumlah_nilai_similarity' => $jumlahSimilarity,
                'jumlah_nilai_bobot' => $jumlahBobot
            ];
        }
        
        foreach ($jumlahNilaiSimilarity as $i => $nilai) {
            $nilaiBobot = $jumlahNilaiBobot[$i];
            
            if ($nilaiBobot !== 0) {
                $persentase[$i]['persentase'] = ($nilai / $nilaiBobot) * 100;
            } else {
                $persentase[$i]['persentase'] = 0;
            }
        }


        $maxPersentase = max(array_column($persentase, 'persentase'));
        $penyakitIdTerbesarIndex = array_search($maxPersentase, array_column($persentase, 'persentase'));
        $penyakitIdTerbesar = $persentase[$penyakitIdTerbesarIndex]['penyakit_id'];

        if ($maxPersentase >= 0 && $maxPersentase <= 49) {
            $kriteria = 'LOW';
        } elseif ($maxPersentase >= 50 && $maxPersentase <= 69) {
            $kriteria = 'MEDIUM';
        } elseif ($maxPersentase >= 70 && $maxPersentase <= 100) {
            $kriteria = 'HIGH';
        }

        $data = [
            'pasien_id' => $this->request->getVar('pasien_id'),
            'gejala'    => json_encode($kasusBaru),
            'penyakit_id' => $penyakitIdTerbesar,
            'tanggal'   => $this->request->getVar('tanggal'),
            'persenan'  => $maxPersentase,
            'kriteria'  => $kriteria,
        ];

        $this->modelDiagnosa->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_diagnosa');
    }

    public function hapus_diagnosa($id = null)
    {
        $this->modelDiagnosa->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_diagnosa');
    }

    public function lihat_hasil($id = null)
    {
        $diagnosa = $this->modelDiagnosa->select('nama, img, deskripsi, perawatan, gejala, persenan')
            ->join('data_penyakit', 'data_penyakit.id = hasil_diagnosa.penyakit_id')
            ->find($id);


        $gejalaPasien = json_decode($diagnosa['gejala'], true);
        $gejala = $this->modelGejala->getGejala()->whereIn('id', $gejalaPasien)->findAll();

        $data = [
            'title' => 'Hasil Diagnosa',
            'data' => $diagnosa,
            'gejala' => $gejala
        ];
        return view('diagnosa/hasil_diagnosa', $data);
    }

    public function hapus_semua_diagnosa()
    {
        $this->modelDiagnosa->truncate();
        session()->setFlashdata('pesan', 'Semua Data berhasil dihapus');
        return redirect()->to('daftar_diagnosa');
    }
}
