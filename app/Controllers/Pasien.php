<?php

namespace App\Controllers;

use App\Models\ModelUsers;

class Pasien extends BaseController
{

    protected $modelPasien;

    public function __construct()
    {
        $this->modelPasien = new ModelUsers();
    }

    public function daftar_pasien()
    {
        $pasien = $this->modelPasien->select('users.id, username, no_rm, users.name, jk, umur')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name', 'pasien')
            ->findAll();

        $data = [
            'title' => 'Manajemen Pasien',
            'data'  => $pasien
        ];

        return view('pasien/daftar_pasien', $data);
    }

    public function edit_pasien($id)
    {
        $pasien = $this->modelPasien->select('users.id, username, no_rm, users.name as nama, jk, umur')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name', 'pasien')
            ->find($id);

        $no_rm = sprintf("PA%02d", $id - 1);

        $data = [
            'title' => 'Form Edit Pasien',
            'pasien' => $pasien,
            'no_rm' => $no_rm
        ];

        return view('pasien/edit_pasien', $data);
    }

    public function perbarui_pasien($id)
    {
        $rules = [
            'no_rm' => [
                'rules' => 'required|is_unique[users.no_rm,id,' . $id . ']',
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
            'name' => $nama,
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
