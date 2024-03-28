<?php

namespace App\Controllers;

use App\Models\ModelPenyakit;
use App\Models\ModelRelasi;

class Penyakit extends BaseController
{

    protected $modelPenyakit, $modelRelasi;

    public function __construct()
    {
        $this->modelPenyakit = new ModelPenyakit();
        $this->modelRelasi = new ModelRelasi();
    }


    public function daftar_penyakit()
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->orderBy('kode', 'asc')->findAll();

        $data = [
            'title' => 'Data Penyakit',
            'data'  => $penyakit
        ];

        return view('penyakit/daftar_penyakit', $data);
    }

    public function tambah_penyakit()
    {
        $id = $this->modelPenyakit->getPenyakit()->orderBy('id', 'desc')->first();

        if (!empty($id['id'])) {
            $kode = sprintf("P%02d", $id['id'] + 1);
        } else {
            $kode = 'P01';
        }

        $data = [
            'title' => 'Form Tambah Penyakit',
            'kode'  => $kode
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
            'img' => [
                'rules' => 'max_size[img,3000]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File yang dipilih bukan gambar.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimum 3MB.',
                    'mime_in'  => 'Tipe file yang dipilih bukan jpg, jpeg, atau png.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');
        $perawatan = $this->request->getVar('perawatan');

        $fileImage = $this->request->getFile('img');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img', $namaImage);
        }

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'perawatan' => $perawatan,
            'img' => $namaImage
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
            'img' => [
                'rules' => 'max_size[img,3000]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File yang dipilih bukan gambar.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimum 3MB.',
                    'mime_in'  => 'Tipe file yang dipilih bukan jpg, jpeg, atau png.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $deskripsi = $this->request->getVar('deskripsi');
        $perawatan = $this->request->getVar('perawatan');

        $fileImage = $this->request->getFile('img');
        $imageLama = $this->request->getVar('gambarLama');

        if ($fileImage->getError() == 4) {
            $namaImage = $imageLama;
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img', $namaImage);
            if ($imageLama !== 'default.jpg') {
                unlink('img/' . $imageLama);
            }
        }

        $data = [
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'perawatan' => $perawatan,
            'img' => $namaImage,
        ];

        $this->modelPenyakit->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
        return redirect()->to('daftar_penyakit');
    }

    public function hapus_penyakit($id)
    {
        $gambar = $this->modelPenyakit->find($id)['img'];
        if ($gambar !== 'default.jpg') {
            unlink('img/' . $gambar);
        }

        $this->modelPenyakit->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('daftar_penyakit');
    }

    public function lihat_penyakit($id)
    {
        $penyakit = $this->modelPenyakit->getPenyakit()->find($id);

        $gejala = $this->modelRelasi->select('data_gejala.nama as namaG')
            ->join('data_penyakit', 'data_penyakit.id = relasi_gp.pyk_id')
            ->join('data_gejala', 'data_gejala.id = relasi_gp.gjl_id')
            ->where('pyk_id', $id)->find();

        $data = [
            'title' => $penyakit['nama'],
            'data' => $penyakit,
            'gejala' => $gejala
        ];

        return view('penyakit/lihat_penyakit', $data);
    }

    public function hapus_semua_penyakit()
    {
        $files = glob(ROOTPATH . 'public/img/*');

        foreach ($files as $file) {
            if (is_file($file) && basename($file) !== 'default.jpg') {
                unlink($file);
            }
        }
        $this->modelPenyakit->truncate();
        session()->setFlashdata('pesan', 'Semua Data berhasil dihapus');
        return redirect()->to('daftar_penyakit');
    }
}
