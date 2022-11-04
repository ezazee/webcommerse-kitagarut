<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class TransaksiModel extends Model
{

    public function get_pesananku()
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.*, b.*, c.*, d.nama_pel');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'c.id_produk = b.id_prod_trns', 'left');
        $query->join('tbl_pelanggan d', 'd.id_pel = a.id_pelanggan_trans', 'left');
        $query->orderBy('a.id_trans', 'desc');
        $query->groupBy("a.no_trans");
        return $query;
    }

    public function get_detail_pesananku($inv)
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.*, b.*, c.*');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'c.id_produk = b.id_prod_trns', 'left');
        $query->orderBy('a.id_trans', 'desc');
        $query->where(['a.no_trans' => $inv]);

        return $query;
    }

    public function pembayaran()
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.*, b.*, c.*');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'c.id_produk = b.id_prod_trns', 'left');
        $query->orderBy('a.id_trans', 'desc');
        $query->where(['a.status_trans' => 1]);
        $query->groupBy("a.no_trans");
        return $query;
    }

    public function pengiriman()
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.*, b.*, c.*');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'c.id_produk = b.id_prod_trns', 'left');
        $query->orderBy('a.id_trans', 'desc');
        $query->where(['a.status_trans' => 2]);
        $query->groupBy("a.no_trans");
        return $query;
    }

    public function get_nama_pel($no_trans)
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.id_pelanggan_trans, a.no_trans, b.nama_pel, b.no_hp_pel');
        $query->join('tbl_pelanggan b', 'b.id_pel = a.id_pelanggan_trans', 'left');
        $query->where(['a.no_trans' => $no_trans]);

        return $query;
    }

    public function get_merchant($no_trans)
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.no_trans, d.nama_seller, d.no_hp_merchant');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'b.id_prod_trns = c.id_produk', 'left');
        $query->join('tbl_merchant d', 'd.id_merchant = c.id_merchant_prod', 'left');
        $query->where(['a.no_trans' => $no_trans]);
        $query->groupBy("a.no_trans");

        return $query;
    }
}
