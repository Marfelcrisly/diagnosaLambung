<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelKasusLama;
use App\Models\ModelPenyakit;
use App\Models\ModelGejala;
use App\Models\ModelBobot;

class KasusLama extends BaseController
{
    use ResponseTrait;

    protected $modelKasusLama, $modelPenyakit, $modelGejala, $modelBobot;

    public function __construct()
    {
        $this->modelKasusLama = new ModelKasusLama();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelGejala = new ModelGejala();
        $this->modelBobot = new ModelBobot();
    }

    public function daftar_kasusLama()
    {
        $currentPage = $this->request->getVar('page_kasusLama') ? $this->request->getVar('page_kasusLama') : 1;
        $keyword = $this->request->getVar('keyword');

        $kasusLamaQuery = $this->modelKasusLama
            ->select('data_kasusLama.id, data_penyakit.nama, bobot, gejala')
            ->join('data_penyakit', 'data_penyakit.id = data_kasusLama.penyakit_id')
            ->orderBy('data_penyakit.nama', 'asc');

        if ($keyword) {
            $kasusLamaQuery = $kasusLamaQuery->like('nama', $keyword);
        }

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $kasusLama = $kasusLamaQuery->paginate($page, 'kasusLama', $currentPage);

        $data = [];

        foreach ($kasusLama as $kasus) {
            $gejala = json_decode($kasus['gejala'], true);
            $bobot = json_decode($kasus['bobot'], true);

            $gejalaData = $this->modelGejala->whereIn('id', $gejala)->findAll();
            $bobotData = [];
            foreach ($bobot as $id) {
                $bobotDetail = $this->modelBobot->find($id);
                if ($bobotDetail) {
                    $bobotData[] = $bobotDetail;
                }
            }

            $data[] = [
                'id' => $kasus['id'],
                'nama_penyakit' => $kasus['nama'],
                'gejala' => $gejalaData,
                'bobot' => $bobotData
            ];
        }

        $viewData = [
            'title' => 'Data Kasus Lama',
            'data' => $data,
            'kasusLama' => $kasusLama,
            'currentPage' => $currentPage,
            'pager' => $this->modelKasusLama->pager,
            'keyword' => $keyword,
            'page'       => $page,
        ];

        return view('kasusLama/daftar_kasusLama', $viewData);
    }

    public function tambah_kasusLama()
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->findAll();

        $gejala = $this->modelGejala->getGejala()->orderBy('nama', 'asc')->findAll();

        $bobot = $this->modelBobot->getBobot()->findAll();

        $data = [
            'title' => 'Form Tambah Kasus Lama',
            'penyakit'  => $penyakit,
            'namaGejala' => $gejala,
            'bobot'     => $bobot
        ];

        return view('kasusLama/tambah_kasusLama', $data);
    }

    public function simpan_kasusLama()
    {
        $rules = [
            'penyakit_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien harus dipilih',
                ]
            ],
            'diagnosa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Salah satu gejala harus dipilih',
                ]
            ],
            'bobot' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Salah satu bobot harus dipilih',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $penyakit_id = $this->request->getVar('penyakit_id');
        $gejala = json_encode($this->request->getVar('diagnosa'));
        $bobot = json_encode($this->request->getVar('bobot'));

        $data = [
            'penyakit_id' => $penyakit_id,
            'gejala' => $gejala,
            'bobot'  => $bobot
        ];

        $this->modelKasusLama->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_kasusLama');
    }

    public function edit_kasusLama($id = null)
    {
        $kasusLama = $this->modelKasusLama->getKasusLama()->find($id);

        $gejalaLama = json_decode($kasusLama['gejala']);
        $bobotLama = json_decode($kasusLama['bobot']);

        $penyakit = $this->modelPenyakit->getPenyakit()->findAll();

        $gejala = $this->modelGejala->getGejala()->orderBy('nama', 'asc')->findAll();

        $bobot = $this->modelBobot->getBobot()->findAll();

        $data = [
            'title' => 'Form Edit Kasus Lama',
            'penyakit'  => $penyakit,
            'namaGejala' => $gejala,
            'bobot'     => $bobot,
            'kasusLama' => $kasusLama,
            'gejalaLama' => $gejalaLama,
            'bobotLama' => $bobotLama
        ];

        return view('kasusLama/edit_kasusLama', $data);
    }

    public function hapus_kasusLama($id = null)
    {
        $this->modelKasusLama->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_kasusLama');
    }

    public function hapus_semua_kasusLama()
    {
        $this->modelKasusLama->truncate();
        session()->setFlashdata('pesan', 'Semua Data berhasil dihapus');
        return redirect()->to('daftar_kasusLama');
    }
}
