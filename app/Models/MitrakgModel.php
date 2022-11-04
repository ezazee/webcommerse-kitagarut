<?php

namespace App\Models;

use CodeIgniter\Model;

class MitrakgModel extends Model

{
    // <--------------------------------MERCHANT----------------------------------->
    public function getMerchant($id_mitra)
    {
        $query = $this->db->table('tbl_merchant a');
        $query->select('a.*, b.nama_mitra');
        $query->join('tbl_mitra b', 'b.id_mitra = a.id_mitra_merchant', 'left');
        $query->where(['a.id_mitra_merchant' => $id_mitra]);

        return $query;
    }

    public function tambahMerchant($data)
    {
        $query = $this->db->table('tbl_merchant')->insert($data);
        return $query;
    }

    public function updateMerchant($data, $id_merchant)
    {
        $query = $this->db->table('tbl_merchant')->update($data, array('id_merchant' => $id_merchant));
        return $query;
    }

    public function deleteMerchant($id)
    {
        $query = $this->db->table('tbl_merchant')->delete(array('id_merchant' => $id));
        return $query;
    }

    public function getProdukById($id_merchant)
    {
        $query = $this->db->table('tbl_merchant a');
        $query->select('a.*, b.nama_mitra');
        $query->join('tbl_mitra b', 'b.id_mitra = a.id_mitra_merchant', 'left');
        $query->where(['a.id_merchant' => $id_merchant]);

        return $query;
    }

    public function get_edit_merchant($id)
    {
        $query = $this->db->table('tbl_merchant a');
        $query->select('a.*, b.nama_mitra');
        $query->join('tbl_mitra b', 'b.id_mitra = a.id_mitra_merchant', 'left');
        $query->where(['a.id_merchant' => $id]);

        return $query;
    }

    // PRODUK

    public function get_produk($id_mitra)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->orderBy('a.id_produk', 'desc');
        $query->where(['a.id_mitra_produk' => $id_mitra]);
        return $query;
    }

    public function getKategori()
    {
        return $this->db->table('tbl_kategori')->get()->getResultArray();
    }

    public function getSubKategori()
    {
        $query = $this->db->table('tbl_sub_kategori a');
        $query->select('a.*, b.nama_kat');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_s', 'left');

        return $query;
    }

    public function get_satuan()
    {
        return $this->db->table('tbl_satuan')->get()->getResultArray();
    }
    public function tambahProd($data)
    {
        $query = $this->db->table('tbl_produk')->insert($data);
        return $query;
    }

    public function updateKar($data, $id)
    {
        $query = $this->db->table('tbl_peserta')->update($data, array('id_peserta' => $id));
        return $query;
    }
    public function getProdukById2($id)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->where(['a.id_produk' => $id]);

        return $query;
    }

    function get_sub_category($category_id)
    {
        $query = $this->db->table('tbl_sub_kategori')->getWhere(array('id_kat_s' => $category_id))->getResult();
        return $query;
    }

    public function updateProdukact($data, $product_id)
    {
        $query = $this->db->table('tbl_produk')->update($data, array('id_produk' => $product_id));
        return $query;
    }

    public function deleteprod($id)
    {
        $query = $this->db->table('tbl_produk')->delete(array('id_produk' => $id));
        return $query;
    }
}
