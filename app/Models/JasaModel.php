<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaModel extends Model
{

    protected $table = "tbl_jasa";

    // <--------------------------------PRODUK----------------------------------->

    public function get_jasa()
    {
        $query = $this->db->table('tbl_jasa a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_jasa', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_penyedia', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_jasa', 'left');
        $query->orderBy('a.id_jasa', 'desc');
        return $query;
    }

    public function getMerchant()
    {
        return $this->db->table('tbl_merchant')->get()->getResultArray();
    }

    public function getKategori()
    {
        return $this->db->table('tbl_kategori')->get()->getResultArray();
    }

    public function get_satuan()
    {
        return $this->db->table('tbl_satuan')->get()->getResultArray();
    }

    public function getSubKategori()
    {
        $query = $this->db->table('tbl_sub_kategori a');
        $query->select('a.*, b.nama_kat');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_s', 'left');


        return $query;
    }

    public function getJasaSingle($id_sub_kat)
    {
        $query = $this->db->table('tbl_jasa a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_jasa', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_penyedia', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_jasa', 'left');       
        $query->orderBy('a.id_jasa', 'DESC');
        $query->where(['a.id_sub_kat_jasa' => $id_sub_kat]);
        $query->limit(7);

        return $query;
    }

    public function getJasaSingle2($id_kat)
    {
        $query = $this->db->table('tbl_jasa a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_jasa', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_penyedia', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_jasa', 'left');       
        $query->orderBy('a.id_jasa', 'DESC');
        $query->where(['a.id_kat_jasa' => $id_kat]);
        $query->limit(2);

        return $query;
    }

    function get_sub_category($category_id)
    {
        $query = $this->db->table('tbl_sub_kategori')->getWhere(array('id_kat_s' => $category_id))->getResult();
        return $query;
    }

    public function getJasaById($slug)
    {
        $query = $this->db->table('tbl_jasa a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_jasa', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_penyedia', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_jasa', 'left');
        $query->where(['a.slug_jasa' => $slug]);

        return $query;
    }

    public function get_edit_produk($id)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->where(['a.id_produk' => $id]);

        return $query;
    }

    public function inputjasa($data)
    {
        $query = $this->db->table('tbl_jasa')->insert($data);
        return $query;
    }

    public function updateKar($data, $id)
    {
        $query = $this->db->table('tbl_peserta')->update($data, array('id_peserta' => $id));
        return $query;
    }

    public function deletekar($id)
    {
        $query = $this->db->table('tbl_peserta')->delete(array('id_peserta' => $id));
        return $query;
    }
}
