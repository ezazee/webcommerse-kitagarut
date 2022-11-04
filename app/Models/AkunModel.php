<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = "tbl_pelanggan";

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

    function get_provinsi()
    {
        $query = $this->db->table('wilayah_provinsi a');
        $query->select("a.id_prov,concat(a.nama_prov, ' (',count(b.provinsi_id),' ', 'Kabupaten',')') as jmh");
        $query->join('wilayah_kabupaten b', 'a.id_prov=b.provinsi_id', 'inner');
        $query->groupBy('a.id_prov');
        $provinsi =  $query->get();

        return $provinsi;
    }

    function get_kabupaten($provinsi_id)
    {
        $query = $this->db->table('wilayah_kabupaten a');
        $query->select("id_kab,concat(a.nama_kab,' (', count(b.kabupaten_id), ' ', 'Kecamatan',')') as nama_kab");
        $query->join('wilayah_kecamatan b', 'a.id_kab=b.kabupaten_id', 'inner');
        $query->where(['a.provinsi_id' => $provinsi_id]);
        $query->groupBy('a.id_kab');
        $kabupaten = $query->get();

        return $kabupaten;
    }
    function get_kecamatan($kabupaten_id)
    {
        $query = $this->db->table('wilayah_kecamatan')->getWhere(['kabupaten_id' => $kabupaten_id]);
        return $query;
    }

    function get_desa($kecamatan_id)
    {
        $query = $this->db->table('wilayah_desa a');
        $query->select("a.id_desa, a.nama_desa");
        $query->where(['a.kecamatan_id' => $kecamatan_id]);
        $query->groupBy('a.id_desa');
        $kecamatan = $query->get();

        return $kecamatan;
    }

    public function getPelanggan($id)
    {
        $query = $this->db->table('tbl_pelanggan a');
        $query->select('a.*, b.nama_prov, c.nama_kab, d.nama_kec');
        $query->join('wilayah_provinsi b', 'a.provinsi=b.id_prov', 'inner');
        $query->join('wilayah_kabupaten c', 'a.kota=c.id_kab', 'inner');
        $query->join('wilayah_kecamatan d', 'a.kecamatan=d.id_kec', 'inner');
        $query->where(['a.id_pel' => $id]);

        return $query;
    }

    public function getAlamatMerchant($id_merchant)
    {
        $query = $this->db->table('tbl_merchant a');
        $query->select('a.*, b.nama_prov, c.nama_kab, d.nama_kec');
        $query->join('wilayah_provinsi b', 'a.provinsi_merchant=b.id_prov', 'inner');
        $query->join('wilayah_kabupaten c', 'a.kota_merchant=c.id_kab', 'inner');
        $query->join('wilayah_kecamatan d', 'a.kecamatan_merchant=d.id_kec', 'inner');
        $query->where(['a.id_merchant' => $id_merchant]);

        return $query;
    }

    public function getTarif($origin, $destination)
    {
        $query = $this->db->table('tbl_tarif_carlos');
        $query->select('*');
        $query->where(['origin_id' => $origin, 'destinasi_id' => $destination]);

        return $query;
    }

    public function SimpanProfil($data)
    {
        $query = $this->db->table('tbl_pelanggan')->insert($data);
        return $query;
    }

    public function UpdateProfil($id_pel, $data)
    {
        $query = $this->db->table('tbl_pelanggan')->update($data, array('id_pel' => $id_pel));
        return $query;
    }
}
