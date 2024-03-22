<?php

namespace App\Controllers;

use App\Models\ModelPenyakit;

class Penyakit extends BaseController
{

    protected $modelPenyakit;



    public function __construct()
    {
        $this->modelPenyakit = new ModelPenyakit();
    }


    public function daftar_penyakit()
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->findAll();

        $data = [
            'title' => 'Manajemen Penyakit',
            'data'  => $penyakit
        ];

        return view('penyakit/daftar_penyakit', $data);
    }

    public function tambah_penyakit()
    {
        $data = [
            'title' => 'Form Tambah Penyakit',
        ];

        return view('penyakit/tambah_penyakit', $data);
    }

    public function simpan_penyakit()
    {
        $rules = [
            'kode' => [
                'rules' => 'required|is_unique[data_penyakit.kode]',
                'errors' => [
                    'required' => 'Kode harus diisi',
                    'is_unique' => 'Kode sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama penyakit harus diisi|is_unique[data_penyakit.nama]',
                    'is_unique' => 'Nama penyakit sudah ada'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
            'perawatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perawatan harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');
        $perawatan = $this->request->getVar('perawatan');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'perawatan' => $perawatan,
        ];

        $this->modelPenyakit->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_penyakit');
    }

    public function edit_penyakit($id)
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->find($id);

        $data = [
            'title' => 'Form Edit Penyakit',
            'data' => $penyakit
        ];

        return view('penyakit/edit_penyakit', $data);
    }

    public function perbarui_penyakit($id)
    {
        $rules = [
            'kode' => [
                'rules' => 'required|is_unique[data_penyakit.kode,id,' . $id . ']',
                'errors' => [
                    'required' => 'Kode harus diisi',
                    'is_unique' => 'Kode sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama penyakit harus diisi|is_unique[data_penyakit.nama,id,' . $id . ']',
                    'is_unique' => 'Nama penyakit sudah ada'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
            'perawatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perawatan harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');
        $perawatan = $this->request->getVar('perawatan');

        $data = [
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'perawatan' => $perawatan,
        ];

        $this->modelPenyakit->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_penyakit');
    }

    public function hapus_penyakit($id)
    {
        $this->modelPenyakit->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_penyakit');
    }

    public function lihat_penyakit($id)
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->find($id);

        $data = [
            'title' => $penyakit['nama'],
            'data' => $penyakit
        ];

        return view('penyakit/lihat_penyakit', $data);
    }
}
