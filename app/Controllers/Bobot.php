<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModelBobot;

class Bobot extends BaseController
{
    use ResponseTrait;

    protected $modelBobot;

    public function __construct()
    {
        $this->modelBobot = new ModelBobot();
    }


    public function daftar_bobot()
    {
        $currentPage = $this->request->getVar('page_bobot') ? $this->request->getVar('page_bobot') : 1;
        $bobot = $this->modelBobot->getBobot()->orderBy('nilai', 'desc');

        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;
        $data = $bobot->paginate($page, 'bobot', $currentPage);


        $data = [
            'title' => 'Data Bobot',
            'data'  => $data,
            'pager'      => $this->modelBobot->pager,
            'currentPage' => $currentPage,
            'page'       => $page,
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

    public function edit_bobot($id = null)
    {
        $bobot = $this->modelBobot->getBobot()->find($id);

        $data = [
            'title' => 'Form Edit Bobot',
            'data' => $bobot
        ];

        return view('bobot/edit_bobot', $data);
    }

    public function perbarui_bobot($id = null)
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

    public function hapus_bobot($id = null)
    {
        $this->modelBobot->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_bobot');
    }

    public function hapus_semua_bobot()
    {
        $this->modelBobot->truncate();
        session()->setFlashdata('pesan', 'Semua Data berhasil dihapus');
        return redirect()->to('daftar_bobot');
    }
}
