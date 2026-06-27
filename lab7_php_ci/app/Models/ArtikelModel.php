<?php
namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields = [
        'judul', 
        'isi', 
        'gambar', 
        'status', 
        'slug', 
        'id_kategori',
        'created_at'
    ];

    protected $returnType = 'array';

    // Relasi dengan tabel kategori (Praktikum 6)
    public function getArtikelDenganKategori()
    {
        return $this->db->table('artikel')
                        ->select('artikel.*, kategori.nama_kategori')
                        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                        ->orderBy('artikel.id', 'DESC')
                        ->get()
                        ->getResultArray();
    }

    // Optional: Method untuk mendapatkan artikel dengan pagination + filter (Praktikum 5 & 9)
    public function getArtikelWithFilter($q = '', $kategori_id = '')
    {
        $builder = $this->db->table('artikel')
                            ->select('artikel.*, kategori.nama_kategori')
                            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if (!empty($q)) {
            $builder->like('artikel.judul', $q);
        }

        if (!empty($kategori_id)) {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        return $builder;
    }
}