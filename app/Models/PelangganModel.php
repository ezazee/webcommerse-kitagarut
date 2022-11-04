<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class PelangganModel extends Model
{

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
}
