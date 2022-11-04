<?php

namespace App\Controllers\Backend;

\Config\Database::connect();

use App\Models\TugasModel;
use App\Models\HomeModel;

use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->T_mod = new TugasModel();
        $this->H_mod = new HomeModel();
        $this->cek_login();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }
        $db = db_connect();
        $builder = $this->user_aktif();
        $sekarang = Date('Y-m-d');
        $bulan_ini = Date('m');
        $user_aktif = $builder['id_peserta'];

        $grafik_pesanan = $this->H_mod->grafik_pesanan();
        $jumlah_pelanggan = $this->H_mod->jumlah_pelanggan();
        $jumlah_merchant = $this->H_mod->jumlah_merchant();
        $jumlah_produk = $this->H_mod->jumlah_produk();
        $jumlah_pesanan = $this->H_mod->jumlah_pesanan();
        $pesanan_selesai = $this->H_mod->pesanan_selesai();
        $pesanan_berjalan = $this->H_mod->pesanan_berjalan();
        $pesanan_batal = $this->H_mod->pesanan_batal();
        $jumlah_pelanggan_baru = $this->H_mod->jumlah_pelanggan_baru();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Dashboard',
            'menu' => 'Home',
            'user' => $builder,
            'jumlah_pelanggan_baru' => $jumlah_pelanggan_baru,
            'pesanan_batal' => $pesanan_batal,
            'pesanan_berjalan' => $pesanan_berjalan,
            'pesanan_selesai' => $pesanan_selesai,
            'jumlah_pesanan' => $jumlah_pesanan,
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'jumlah_produk' => $jumlah_produk,
            'jumlah_merchant' => $jumlah_merchant,
            'grafik_pesanan' => $grafik_pesanan,
            'bulan_ini' => $bulan_ini,

        ];
        return view('backend/home/index', $data);
    }

    public function notif()
    {
        $notif = $this->ambil_notif();

        echo json_encode($notif);
    }

    public function register()

    {

        $data = [

            'judul' => 'Daftar LPK',

        ];



        return view('/admin/register', $data);
    }



    //--------------------------------------------------------------------



}
