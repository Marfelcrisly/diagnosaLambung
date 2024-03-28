<?php

namespace App\Controllers;

use App\Models\ModelBobot;

class Bobot extends BaseController
{

    protected $modelBobot;



    public function __construct()
    {
        $this->modelBobot = new ModelBobot();
    }


    public function daftar_bobot()
    {
        $bobot = $this->modelBobot->getBobot()->orderBy('nilai', 'desc')->findAll();

        $data = [
            'title' => 'Data Bobot',
            'data'  => $bobot
        ];

        return view('bobot/daftar_bobot', $data);
    }

    public function tambah_bobot()
    {
        $data = [
            'title' => 'Form Tambah Bobot',
        ];

        return view('bobot/tambah_bobot', $data);
    }

    public function simpan_bobot()
    {
        $rules = [
            'parameter' => [
                'rules' => 'required|is_unique[bobot.parameter]',
                'errors' => [
                    'required' => 'Parameter harus diisi',
                    'is_unique' => 'Parameter sudah ada'
                ]
            ],
            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai Bobot harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parameter = $this->request->getVar('parameter');
        $nilai = $this->request->getVar('nilai');

        $data = [
            'parameter' => $parameter,
            'nilai' => $nilai,
        ];

        $this->modelBobot->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('daftar_bobot');
    }

    public function edit_bobot($id)
    {
        $bobot = $this->modelBobot->getBobot()->find($id);

        $data = [
            'title' => 'Form Edit Bobot',
            'data' => $bobot
        ];

        return view('bobot/edit_bobot', $data);
    }

    public function perbarui_bobot($id)
    {
        $rules = [
            'parameter' => [
                'rules' => 'required|is_unique[bobot.parameter,id,' . $id . ']',
                'errors' => [
                    'required' => 'Parameter harus diisi',
                    'is_unique' => 'Parameter sudah ada'
                ]
            ],
            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parameter = $this->request->getVar('parameter');
        $nilai = $this->request->getVar('nilai');

        $data = [
            'id' => $id,
            'parameter' => $parameter,
            'nilai' => $nilai,
        ];

        $this->modelBobot->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_bobot');
    }

    public function hapus_bobot($id)
    {
        $this->modelBobot->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_bobot');
    }
}
