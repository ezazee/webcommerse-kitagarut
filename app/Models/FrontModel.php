<?php

namespace App\Models;

use CodeIgniter\Model;

class FrontModel extends Model
{
    protected $table = "tbl_produk";


    public function register($data)
    {
        return $this->db->table('tbl_pelanggan')->insert($data);
    }

    public function simpan_transaksi($data)
    {
        return $this->db->table('tbl_transaksi')->insert($data);
    }

    public function update_transaksi_pembayaran($data, $no_trans)
    {
        $query = $this->db->table('tbl_transaksi')->update($data, array('no_trans' => $no_trans));
        return $query;
    }

    public function simpan_detail_transaksi($data2)
    {
        return $this->db->table('detail_transaksi')->insert($data2);
    }

    public function insert_otp($insertdb)
    {
        return $this->db->table('tbl_otp')->insert($insertdb);
    }

    public function check_login($email)
    {
        $builder = $this->db->table('tbl_pelanggan');
        $builder->where(array('email_pel' => $email));

        return $builder->get()->getRowArray();
    }

    public function validasi_otp($no_hp_pel)
    {
        $builder = $this->db->table('tbl_otp');
        $builder->where(array('nomer' => $no_hp_pel));

        return $builder->get()->getRowArray();
    }

    function cek_otp($no_hp_pel)
    {
        $builder = $this->db->table('tbl_otp');
        $builder->select('nomer');
        $builder->where('nomer', $no_hp_pel);

        return $builder->countAllResults();
    }

    public function delete_otp($no_hp_pel)
    {
        $query = $this->db->table('tbl_otp')->delete(array('nomer' => $no_hp_pel));
        return $query;
    }

    function get_no_invoice()
    {
        $builder = $this->db->table('tbl_transaksi');
        $builder->select('MAX(RIGHT(no_trans,4)) as kd_max');
        $builder->where('DATE(tgl_trans)=CURDATE()');
        $array = $builder->get()->getResult();
        $kd = "";
        if ($builder->countAllResults() > 0) {
            foreach ($array as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        date_default_timezone_set('Asia/Jakarta');
        return "KG" . "-" . date('dmy') . $kd;
    }

    public function getProdukTerbaru()
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'desc');
        $query->limit(10);

        return $query;
    }

    public function get_pesananku($id)
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.*, b.*, c.*');
        $query->join('detail_transaksi b', 'b.no_trns = a.no_trans', 'left');
        $query->join('tbl_produk c', 'c.id_produk = b.id_prod_trns', 'left');
        $query->orderBy('a.id_trans', 'desc');
        $query->where(['a.id_pelanggan_trans' => $id]);
        $query->groupBy("a.no_trans");
        return $query;
    }

    public function total_belum_bayar($inv)
    {
        $query = $this->db->table('tbl_transaksi a');
        $query->select('a.total_belanja_ongkir');
        $query->where(['no_trans' => $inv]);
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

    public function getBestSeller()
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'RANDOM');
        $query->limit(8);

        return $query;
    }

    public function getAllProduk()
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'DESC');
        $query->limit(10);

        return $query;
    }

    public function getAll()
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'asc');
        $query;

        return $query;
    }

    public function getKategori()
    {
        $query = $this->db->table('tbl_kategori a');
        $query->select('a.*, b.id_kat_prod');
        $query->join('tbl_produk b', 'a.id_kat = b.id_kat_prod', 'left');
        $query->orderBy('a.id_kat', 'asc');
        $query->groupBy('b.id_kat_prod');


        return $query;
    }

    public function search($keyword)
    {
        // $query = $this->db->table('tbl_produk a');
        // $query->like('a.nama_produk', $keyword);

        // return $query;

        return $this->table('tbl_produk')->like('nama_produk', $keyword);
    }

    public function count_search($keyword)
    {
        return $this->table('tbl_produk')->like('nama_produk', $keyword)->countAllResult();
    }

    public function getProdukById($id)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, c.id_merchant, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'asc');
        $query->where(['a.id_produk' => $id]);

        return $query;
    }

    public function getProdukBySlug($slug)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, c.id_merchant, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'asc');
        $query->where(['a.slug' => $slug]);

        return $query;
    }

    public function getProdukSingle($id_sub_kat)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'RANDOM');
        $query->where(['a.id_sub_kat_prod' => $id_sub_kat]);
        $query->limit(7);

        return $query;
    }

    public function getProdukSingle2($id_kat)
    {
        $query = $this->db->table('tbl_produk a');
        $query->select('a.*, b.nama_kat, c.nama_toko, c.nama_seller, d.nama_peserta, e.nama_sub_kategori, f.nama_satuan');
        $query->join('tbl_kategori b', 'b.id_kat = a.id_kat_prod', 'left');
        $query->join('tbl_merchant c', 'c.id_merchant = a.id_merchant_prod', 'left');
        $query->join('tbl_peserta d', 'd.id_peserta = a.id_created', 'left');
        $query->join('tbl_sub_kategori e', 'e.id_sub_kat = a.id_sub_kat_prod', 'left');
        $query->join('tbl_satuan f', 'f.id_satuan = a.satuan_produk', 'left');
        $query->orderBy('a.id_produk', 'desc');
        $query->where(['a.id_kat_prod' => $id_kat]);
        $query->limit(2);

        return $query;
    }
}
