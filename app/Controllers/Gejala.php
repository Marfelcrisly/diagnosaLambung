<?php

namespace App\Controllers;

use App\Models\ModelGejala;

class Gejala extends BaseController
{

    protected $modelGejala;



    public function __construct()
    {
        $this->modelGejala = new ModelGejala();
    }

    public function daftar_gejala()
    {
        $keyword = $this->request->getVar('keyword');
        $gejala = $this->modelGejala->getGejala()->orderBy('kode', 'asc');

        if ($keyword) {
            $gejala = $gejala->like('nama', $keyword);
        }

        $gejala = $gejala->findAll();

        $data = [
            'title' => 'Data Gejala',
            'data'  => $gejala,
            'keyword' => $keyword
        ];

        return view('gejala/daftar_gejala', $data);
    }

    public function tambah_gejala()
    {
        $id = $this->modelGejala->getGejala()->orderBy('id', 'desc')->first();

        if (!empty($id['id'])) {
            $kode = sprintf("G%02d", $id['id'] + 1);
        } else {
            $kode = 'G01';
        }

        $data = [
            'title' => 'Form Tambah Gejala',
            'kode'  => $kode
        ];

        return view('gejala/tambah_gejala', $data);
    }

    public function simpan_gejala()
    {
        $rules = [
            'kode' => [
                'rules' => 'required|is_unique[data_gejala.kode]',
                'errors' => [
                    'required' => 'Kode harus diisi',
                    'is_unique' => 'Kode sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required|is_unique[data_gejala.nama]',
                'errors' => [
                    'required' => 'Nama gejala harus diisi',
                    'is_unique' => 'Nama gejala sudah ada'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
        ];

        $this->modelGejala->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_gejala');
    }

    public function edit_gejala($id)
    {
        $gejala = $this->modelGejala->getGejala()->find($id);

        $data = [
            'title' => 'Form Edit Gejala',
            'data' => $gejala
        ];

        return view('gejala/edit_gejala', $data);
    }

    public function perbarui_gejala($id)
    {
        $rules = [
            'kode' => [
                'rules' => 'required|is_unique[data_gejala.kode,id,' . $id . ']',
                'errors' => [
                    'required' => 'Kode harus diisi',
                    'is_unique' => 'Kode sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required|is_unique[data_gejala.nama,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama gejala harus diisi',
                    'is_unique' => 'Nama gejala sudah ada'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');

        $data = [
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
        ];

        $this->modelGejala->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_gejala');
    }

    public function hapus_gejala($id)
    {
        $this->modelGejala->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_gejala');
    }

    public function hapus_semua_gejala()
    {
        $this->modelGejala->truncate();
        session()->setFlashdata('pesan', 'Semua Data berhasil dihapus');
        return redirect()->to('daftar_gejala');
    }
}
