<?php

namespace App\Controllers;

use App\Models\ModelRelasi;
use App\Models\ModelPenyakit;
use App\Models\ModelGejala;

class Relasi extends BaseController
{

    protected $modelRelasi, $modelPenyakit, $modelGejala;



    public function __construct()
    {
        $this->modelRelasi = new ModelRelasi();
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelGejala = new ModelGejala();
    }


    public function daftar_relasi()
    {
        $relasi = $this->modelRelasi->select('relasi_gp.id, data_penyakit.kode as kodeP, data_gejala.kode as kodeG, data_penyakit.nama as namaP, data_gejala.nama as namaG')
            ->join('data_penyakit', 'data_penyakit.id = relasi_gp.pyk_id')
            ->join('data_gejala', 'data_gejala.id = relasi_gp.gjl_id')
            ->orderBy('kodeP', 'asc')
            ->orderBy('kodeG', 'asc')
            ->findAll();

        $data = [
            'title' => 'Manajemen Relasi',
            'data'  => $relasi
        ];

        return view('relasi/daftar_relasi', $data);
    }

    public function tambah_relasi()
    {
        $kodePenyakit = $this->modelPenyakit->getPenyakit()->findAll();
        $kodeGejala = $this->modelGejala->getGejala()->findAll();

        $data = [
            'title' => 'Form Tambah Relasi',
            'kodePenyakit' => $kodePenyakit,
            'kodeGejala' => $kodeGejala
        ];

        return view('relasi/tambah_relasi', $data);
    }

    public function simpan_relasi()
    {
        $pyk_id = $this->request->getVar('pyk_id');
        $gjl_id = $this->request->getVar('gjl_id');

        $exist = $this->modelRelasi->getRelasi()
            ->where('pyk_id', $pyk_id)
            ->where('gjl_id', $gjl_id)
            ->first();

        if ($exist) {
            return redirect()->back()->withInput()->with('errors', ['Relasi tersebut sudah ada!']);
        }


        $rules = [
            'pyk_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penyakit harus dipilih',
                ]
            ],
            'gjl_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gejala harus dipilih',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'pyk_id' => $pyk_id,
            'gjl_id' => $gjl_id,
        ];

        $this->modelRelasi->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_relasi');
    }

    public function edit_relasi($id)
    {
        $relasi = $this->modelRelasi->getRelasi()->find($id);

        $kodePenyakit = $this->modelPenyakit->getPenyakit()->findAll();
        $kodeGejala = $this->modelGejala->getGejala()->findAll();

        $data = [
            'title' => 'Form Edit Relasi',
            'data' => $relasi,
            'kodePenyakit' => $kodePenyakit,
            'kodeGejala' => $kodeGejala
        ];

        return view('relasi/edit_Relasi', $data);
    }

    public function perbarui_relasi($id)
    {
        $pyk_id = $this->request->getVar('pyk_id');
        $gjl_id = $this->request->getVar('gjl_id');
        $currentData = $this->modelRelasi->find($id);

        if ($pyk_id != $currentData['pyk_id'] || $gjl_id != $currentData['gjl_id']) {
            $exist = $this->modelRelasi->getRelasi()
                ->where('pyk_id', $pyk_id)
                ->where('gjl_id', $gjl_id)
                ->first();

            if ($exist) {
                return redirect()->back()->withInput()->with('errors', ['Relasi tersebut sudah ada!']);
            }
        }

        $rules = [
            'pyk_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penyakit harus dipilih',
                ]
            ],
            'gjl_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gejala harus dipilih',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'pyk_id' => $pyk_id,
            'gjl_id' => $gjl_id,
        ];

        $this->modelRelasi->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_relasi');
    }

    public function hapus_relasi($id)
    {
        $this->modelRelasi->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_relasi');
    }
}
