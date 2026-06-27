<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // Tampilkan Semua Data (GET)
    public function index()
    {
        $model = new ArtikelModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    // Tampilkan 1 Data (GET)
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }

    // Tambah Data (POST)
    public function create()
    {
        $model = new ArtikelModel();
        $data = [
            'judul'       => $this->request->getVar('judul'),
            'isi'         => $this->request->getVar('isi'),
            'slug'        => url_title($this->request->getVar('judul'), '-', true),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'status'      => 1
        ];

        $model->insert($data);
        
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => ['success' => 'Data artikel berhasil ditambahkan.']
        ];

        return $this->respondCreated($response);
    }

    // Update Data (PUT)
    public function update($id = null)
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
            'id_kategori' => $this->request->getVar('id_kategori')
        ];

        $model->update($id, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => ['success' => 'Data artikel berhasil diubah.']
        ];

        return $this->respond($response);
    }

    // Hapus Data (DELETE)
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->where('id', $id)->delete($id);

        if ($data) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => ['success' => 'Data artikel berhasil dihapus.']
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}