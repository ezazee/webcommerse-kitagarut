<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
  public function grafik_pesanan()
  {
    $month = date('m');
    $db = db_connect();
    $builder = $db->table('tbl_transaksi');
    $builder->select("DATE_FORMAT(tgl_trans, '%d') AS tanggal, SUM(total_belanja) total");
    $builder->where("MONTH(tgl_trans)", $month);
    $builder->groupBy("DAY(tgl_trans)");


    if ($builder->countAllResults() > 0) {
      $query = $builder->get();
      foreach ($query->getResult() as $data) {
        $hasil[] = $data;
      }
      return $hasil;
    } else {
      return 0;
    }
  }

  function jumlah_pelanggan()
  {
    $builder = $this->db->table('tbl_pelanggan');
    $builder->selectCount('id_pel');
    $query = $builder->get()->getResultArray();
    return  $query;
  }
  function jumlah_pelanggan_baru()
  {
    $query = $this->db->query("SELECT  
        DATE_FORMAT(date_created, '%d') AS tanggal,
          COUNT(id_pel) jumlah
        FROM
          tbl_pelanggan
        WHERE DATE_FORMAT(date_created, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')");

    $row = $query->getRow();
    return $row;
  }
  function jumlah_merchant()
  {
    $builder = $this->db->table('tbl_merchant');
    $builder->selectCount('id_merchant');
    $query = $builder->get()->getResultArray();
    return  $query;
  }
  function jumlah_produk()
  {
    $builder = $this->db->table('tbl_produk');
    $builder->selectCount('id_produk');
    $query = $builder->get()->getResultArray();
    return  $query;
  }

  public function jumlah_pesanan()
  {
    $query = $this->db->query("SELECT  
        COUNT(id_trans) jumlah
      FROM
        tbl_transaksi");

    $row = $query->getRow();
    return $row;
  }

  public function pesanan_selesai()
  {
    $query = $this->db->query("SELECT  
        COUNT(id_trans) jumlah
      FROM
        tbl_transaksi
      WHERE status_trans = 3");

    $row = $query->getRow();
    return $row;
  }

  public function pesanan_berjalan()
  {
    $query = $this->db->query("SELECT  
        COUNT(id_trans) jumlah
      FROM
        tbl_transaksi
      WHERE status_trans = 2");

    $row = $query->getRow();
    return $row;
  }

  public function pesanan_batal()
  {
    $query = $this->db->query("SELECT  
        COUNT(id_trans) jumlah
      FROM
        tbl_transaksi
      WHERE status_trans = 5");

    $row = $query->getRow();
    return $row;
  }
}
