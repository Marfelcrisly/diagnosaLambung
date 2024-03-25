<?php

namespace App\Controllers;

use App\Models\ModelPasien;

class Pasien extends BaseController
{

    protected $modelPasien;

    public function __construct()
    {
        $this->modelPasien = new ModelPasien();
    }

    public function daftar_pasien()
    {
        $pasien = $this->modelPasien->getPasien()->orderBy('nama', 'asc')->findAll();

        $data = [
            'title' => 'Manajemen Pasien',
            'data'  => $pasien
        ];

        return view('pasien/daftar_pasien', $data);
    }

    public function tambah_pasien()
    {
        $data = [
            'title' => 'Form Tambah Pasien',
        ];

        return view('pasien/tambah_pasien', $data);
    }

    public function simpan_pasien()
    {
        $rules = [
            'no_rm' => [
                'rules' => 'required|is_unique[data_pasien.no_rm]',
                'errors' => [
                    'required' => 'No. RM harus diisi',
                    'is_unique' => 'No. RM sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dipilih',
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umur harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $no_rm = $this->request->getVar('no_rm');
        $nama = $this->request->getVar('nama');
        $jk = $this->request->getVar('jk');
        $umur = $this->request->getVar('umur');

        $data = [
            'no_rm' => $no_rm,
            'nama' => $nama,
            'jk' => $jk,
            'umur' => $umur,
        ];

        $this->modelPasien->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_pasien');
    }

    public function edit_pasien($id)
    {
        $pasien = $this->modelPasien->getPasien()->find($id);
        $data = [
            'title' => 'Form Edit Pasien',
            'pasien' => $pasien
        ];

        return view('pasien/edit_pasien', $data);
    }

    public function perbarui_pasien($id)
    {
        $rules = [
            'no_rm' => [
                'rules' => 'required|is_unique[data_pasien.no_rm,id,' . $id . ']',
                'errors' => [
                    'required' => 'No. RM harus diisi',
                    'is_unique' => 'No. RM sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dipilih',
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umur harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $no_rm = $this->request->getVar('no_rm');
        $nama = $this->request->getVar('nama');
        $jk = $this->request->getVar('jk');
        $umur = $this->request->getVar('umur');

        $data = [
            'id' => $id,
            'no_rm' => $no_rm,
            'nama' => $nama,
            'jk' => $jk,
            'umur' => $umur,
        ];

        $this->modelPasien->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_pasien');
    }

    public function hapus_pasien($id)
    {
        $this->modelPasien->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_pasien');
    }
}
