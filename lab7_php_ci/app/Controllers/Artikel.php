<?php
namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->getArtikelDenganKategori();

        return view('artikel/index', compact('artikel', 'title'));
    }

    public function view($slug = null)
    {
        $model = new ArtikelModel();
        $artikel = $model->where('slug', $slug)->first();
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    // ===================== ADMIN =====================
    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new ArtikelModel();

        $q            = $this->request->getVar('q') ?? '';
        $kategori_id  = $this->request->getVar('kategori_id') ?? '';
        $page         = $this->request->getVar('page') ?? 1;

        $builder = $model->table('artikel')
                         ->select('artikel.*, kategori.nama_kategori')
                         ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q !== '') {
            $builder->like('artikel.judul', $q);
        }
        if ($kategori_id !== '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        $artikel = $builder->paginate(10, 'default', $page);
        $pager   = $model->pager;

        $data = [
            'title'        => $title,
            'q'            => $q,
            'kategori_id'  => $kategori_id,
            'artikel'      => $artikel,
            'pager'        => $pager
        ];

        // AJAX Response (Praktikum 9)
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        }

        // Normal View
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('artikel/admin_index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules(['judul' => 'required']);

            if ($validation->withRequest($this->request)->run()) {
                $file = $this->request->getFile('gambar');
                $gambar = '';

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move(ROOTPATH . 'public/gambar');
                    $gambar = $file->getName();
                }

                $model = new ArtikelModel();
                $model->insert([
                    'judul'       => $this->request->getPost('judul'),
                    'isi'         => $this->request->getPost('isi'),
                    'slug'        => url_title($this->request->getPost('judul'), '-', true),
                    'gambar'      => $gambar,
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'status'      => 1
                ]);

                return redirect()->to('/admin/artikel');
            }
        }

        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        $data['title'] = 'Tambah Artikel';

        return view('artikel/form_add', $data);
    }

    public function edit($id = null)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);
        if (!$artikel) throw PageNotFoundException::forPageNotFound();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules(['judul' => 'required']);

            if ($validation->withRequest($this->request)->run()) {
                $file = $this->request->getFile('gambar');
                $gambar = $artikel['gambar'];

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move(ROOTPATH . 'public/gambar');
                    $gambar = $file->getName();
                }

                $model->update($id, [
                    'judul'       => $this->request->getPost('judul'),
                    'isi'         => $this->request->getPost('isi'),
                    'slug'        => url_title($this->request->getPost('judul'), '-', true),
                    'gambar'      => $gambar,
                    'id_kategori' => $this->request->getPost('id_kategori')
                ]);

                return redirect()->to('/admin/artikel');
            }
        }

        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        $data['artikel'] = $artikel;
        $data['title'] = 'Edit Artikel';

        return view('artikel/form_edit', $data);
    }

    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }
}