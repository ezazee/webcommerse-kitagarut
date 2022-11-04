<?php

namespace App\Controllers\Backend;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->Trans = new TransaksiModel();
        $this->cek_login();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $pesanan = $this->Trans->get_pesananku()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Transaksi',
            'menu' => 'Pesanan Masuk',
            'user' => $builder,
            'pesanan' => $pesanan,
        ];

        return view('backend/transaksi/index', $data);
    }

    public function detail_pesanan($inv)
    {

        if ($this->cek_login() == FALSE) {
            return redirect()->to(base_url('frontend/new_home/login'));
        }

        $detail_pesanan = $this->Trans->get_detail_pesananku($inv)->get()->getResultArray();


        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Transaksi',
            'menu' => 'Transaksi',
            'submenu' => 'Detail Pesanan Saya',
            'user' => $this->user_aktif(),
            'detail_pesanan' => $detail_pesanan,
            'no_trans' => $inv,

        ];
        return view('backend/transaksi/detail_pesanan', $data);
    }

    public function pembayaran()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $pembayaran = $this->Trans->pembayaran()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Transaksi',
            'menu' => 'Pesanan Masuk',
            'user' => $builder,
            'pembayaran' => $pembayaran,
        ];

        return view('backend/transaksi/pembayaran', $data);
    }

    function terima_pembayaran($inv)
    {
        $db = db_connect();
        $builder = $db->table('tbl_transaksi');
        $builder->set('status_trans', 2);
        $builder->where('no_trans', $inv);
        $builder->update();

        return redirect()->to(base_url('/backend/transaksi/pengiriman'))->with('success', 'Pembayaran berhasil di terima !');;
    }

    function tolak_pembayaran($inv)
    {
        $db = db_connect();
        $builder = $db->table('tbl_transaksi');
        $builder->set('status_trans', 6);
        $builder->where('no_trans', $inv);
        $builder->update();

        return redirect()->to(base_url('/backend/transaksi/pembayaran'))->with('gagal', 'Pembayaran berhasil di tolak !');
    }

    public function pengiriman()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $pengiriman = $this->Trans->pengiriman()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Transaksi',
            'menu' => 'Pesanan Masuk',
            'user' => $builder,
            'pengiriman' => $pengiriman,
        ];

        return view('backend/transaksi/pengiriman', $data);
    }

    public function pesanan_selesai($inv)
    {
        $db = db_connect();
        $builder = $db->table('tbl_transaksi');
        $builder->set('status_trans', 3);
        $builder->where('no_trans', $inv);
        $builder->update();

        return redirect()->to(base_url('/backend/transaksi/pengiriman'))->with('success', 'Pemesanan Sudah Selesai !');
    }

    function kirim_carlos($no_trans)
    {
        // $no_trans = $this->request->getVar('');
        // $no_trans = 'KG-2110200001';
        $pesanan = $this->db->table('detail_transaksi')->getWhere(['no_trns' => $no_trans])->getResultArray();
        $pesanan2 = $this->db->table('tbl_transaksi')->getWhere(['no_trans' => $no_trans])->getRowArray();

        $b = $this->Trans->get_nama_pel($no_trans)->get()->getRowArray();
        $c = $this->Trans->get_merchant($no_trans)->get()->getRowArray();

        $nama_pelanggan = $b['nama_pel'];
        $hp_pelanggan = $b['no_hp_pel'];
        $nama_seller = $c['nama_seller'];
        $hp_seller = $c['no_hp_merchant'];

        $data = [];

        foreach ($pesanan as $row) {
            $data[] = [
                "nama_prod" => $row['nama_produk_trns'],
                "harga_modal" => $row['harga_modal'],
                "harga_jual" => $row['harga_jual'],
                "qty" => $row['qty_trns'],
            ];
        }

        $tgl = shortdate_indo($pesanan2['tgl_trans']);
        $ongkir = $pesanan2['ongkir_trans'];
        $jarak = $pesanan2['jarak_trans'];
        $metode_bayar = $pesanan2['metode_bayar'];

        $total_belanja = $pesanan2['total_belanja_ongkir'];

        $koordinat = $pesanan2['koordinat'];
        $koordinat_merchant = $pesanan2['koordinat_merchant'];
        $produk1 = !empty($data['0']['nama_prod']) ? $data['0']['nama_prod'] : NULL;
        $produk2 = !empty($data['1']['nama_prod']) ? $data['1']['nama_prod'] : NULL;
        $produk3 = !empty($data['2']['nama_prod']) ? $data['2']['nama_prod'] : NULL;
        $produk4 = !empty($data['3']['nama_prod']) ? $data['3']['nama_prod'] : NULL;
        $produk5 = !empty($data['4']['nama_prod']) ? $data['4']['nama_prod'] : NULL;
        $h_m_produk1 = !empty($data['0']['harga_modal']) ? $data['0']['harga_modal'] : NULL;
        $h_j_produk1 = !empty($data['0']['harga_jual']) ? $data['0']['harga_jual'] : NULL;
        $qty = !empty($data['0']['qty']) ? $data['0']['qty'] : NULL;

        $subtotal_m = rupiah($h_m_produk1 * $qty);
        $subtotal_j = rupiah($h_j_produk1 * $qty);
        $fee_kitagarut = rupiah(($h_j_produk1 * $qty) - ($h_m_produk1 * $qty));
        $harga_m_qty = rupiah($h_m_produk1) . ' x ' . $qty . ' = ' . $subtotal_m;
        $harga_j_qty = rupiah($h_j_produk1) . ' x ' . $qty . ' = ' . $subtotal_j;

        $semua = "$produk1,$produk2, $produk3, $produk4 $produk5";

        $telegram_id = '-1001342775101';
        $message_text = '*>>>* _Menunggu Pengiriman KitaGarut_ *<<<' . "*\n\n\n" . 'Tanggal Pesanan : *' . $tgl . ' ' . "*\n" . 'No. Transaksi : * ' . $no_trans . '' . "*\n" . 'Produk : *' . $semua .  "*\n\n\n" . '*>>>* _Rincian Biaya_ *<<<' . "*\n" . 'Jarak : *' . $jarak . 'KM ' . "*\n" . 'Ongkir : *' . rupiah($ongkir) . '' . "*\n" . 'Qty : *' . $qty . '' . "*\n" . 'Harga Modal : *' . $harga_m_qty . '' . "*\n" . 'Harga Jual : *' . $harga_j_qty . '' . "*\n\n" . '*>>>* _Ringkasan Biaya_ *<<<' . "*\n" . 'Bayar ke seller : *' . $subtotal_m . '' . "*\n" . 'Terima dari konsumen : *' . $subtotal_j . ' + ' . rupiah($ongkir) . ' = ' . rupiah($total_belanja) . '' . "*\n" . 'Fee KitaGarut : *' . $fee_kitagarut . '' . "*\n\n" . 'Metode Pembayaran : *' . $metode_bayar . '' . "*\n\n" . 'Nama Seller  : *' . $nama_seller . '' . "*\n" . 'Kontak Seller  : *' . $hp_seller . '' . "*\n" . 'Lokasi Seller : *' . $koordinat_merchant . '' . "*\n\n" . 'Nama Konsumen  : *' . $nama_pelanggan . '' . "*\n" . 'Kontak Konsumen  : *' . $hp_pelanggan . '' . "*\n" . 'Lokasi Konsumen : *' . $koordinat . '' . "*\n" . 'Status Transaksi  : *Menunggu Pengiriman ' . "*\n\n\n*>>>* _Menunggu Pengiriman KitaGarut_ *<<<*" . '';


        /*--------------------------------
        Isi TOKEN dibawah ini: 
        --------------------------------*/
        $secret_token = "1288932506:AAFR58Evq7KXOFI78leAV0rbPuR4zlRpJus";

        $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        return redirect()->to(base_url('/backend/transaksi/pengiriman'))->with('success', 'Pengiriman pesan Berhasil !');
    }
}
