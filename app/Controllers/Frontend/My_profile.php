<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;
use App\Models\AkunModel;

class My_profile extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->cek_login();
        $this->Front_mod = new FrontModel();
        $this->Akun_mod = new AkunModel();
        ini_set('max_execution_time', 300);
    }

    public function index()

    {
        $produkTerbaru = $this->Front_mod->getProdukTerbaru()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $provinsi = $this->Akun_mod->get_provinsi()->getResult();
        $user = $this->user_aktif();


        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'Pelanggan',
            'submenu' => 'Akun Saya',
            'produkTerbaru' => $produkTerbaru,
            'all_produk' => $this->Front_mod->getAllProduk()->get()->getResultArray(),
            'kategori' => $kategori,
            'provinsi' => $provinsi,
            'cart' => \Config\Services::cart(),
            'user' => $user,
            'validation' => \Config\Services::validation(),
        ];

        return view('frontend/myprofile/index_edit', $data);
    }

    function get_kabupaten()
    {
        $provinsi_id = $this->request->getPost('id');
        $data = $this->Akun_mod->get_kabupaten($provinsi_id)->getResult();

        echo json_encode($data);
    }

    public function get_kecamatan()
    {
        $kabupaten_id = $this->request->getPost('id');
        $data = $this->Akun_mod->get_kecamatan($kabupaten_id)->getResult();
        echo json_encode($data);
    }

    public function get_desa()
    {
        $kecamatan_id = $this->request->getPost('id');
        $data = $this->Akun_mod->get_desa($kecamatan_id)->getResult();
        echo json_encode($data);
    }

    function get_data_edit()
    {
        $id_pel = $this->request->getVar('id_pel');
        $data = $this->Akun_mod->getPelanggan($id_pel)->get()->getRowArray();
        echo json_encode($data);
    }

    function UpdateProfil()
    {

        $user = $this->user_aktif();
        $id_pel = $user['id_pel'];

        $nama_pel = $this->request->getPost('nama_pel');
        $email_pel = $this->request->getPost('email_pel');
        $alamat_pel = $this->request->getPost('alamat_pel');
        $no_hp_pel = $this->request->getPost('no_hp_pel');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $kecamatan = $this->request->getPost('kecamatan');

        $data = [

            'kecamatan'     => $kecamatan,
            'kota'     => $kota,
            'provinsi'     => $provinsi,
            'email_pel'     => $email_pel,
            'nama_pel'     => $nama_pel,
            'alamat_pel'     => $alamat_pel,
            'no_hp_pel'     => $no_hp_pel,
            'date_updated'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Akun_mod->UpdateProfil($id_pel, $data);
        return redirect()->to(base_url('/frontend/my_profile'))->with('success', 'Data berhasil di Update !');
    }

    public function pesananku()
    {

        if ($this->cek_login() == FALSE) {
            return redirect()->to(base_url('frontend/new_home/login'));
        }

        $id = session()->get('id_pel');
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $pesananku = $this->Front_mod->get_pesananku($id)->get()->getResultArray();

        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Pesanan Saya',
            'user' => $this->user_aktif(),
            'kategori' => $kategori,
            'pesananku' => $pesananku,
            'validation' => \Config\Services::validation(),
            'cart' => \Config\Services::cart()
        ];
        return view('frontend/myprofile/pesananku', $data);
    }

    public function konfirmasi_bayar($inv)
    {

        if ($this->cek_login() == FALSE) {
            return redirect()->to(base_url('frontend/new_home/login'));
        }
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $detail_pesanan = $this->Front_mod->get_detail_pesananku($inv)->get()->getResultArray();
        $total_belum_bayar = $this->Front_mod->total_belum_bayar($inv)->get()->getResultArray();

        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Konfirmasi Pembayaran',
            'user' => $this->user_aktif(),
            'kategori' => $kategori,
            'inv' => $inv,
            'total_belum_bayar' => $total_belum_bayar,
            'validation' => \Config\Services::validation(),
            'detail_pesanan' => $detail_pesanan,
            'cart' => \Config\Services::cart()
        ];
        return view('frontend/myprofile/konfirmasi_bayar', $data);
    }

    public function bukti_bayar()
    {
        if ($this->cek_login() == FALSE) {
            return redirect()->to(base_url('frontend/new_home/login'));
        }

        if (!$this->validate([
            'bukti' => [
                'rules' => 'ext_in[bukti,png,jpg]|max_size[bukti,2048]',
                'errors' => [
                    'ext_in' => 'Ekstensi File yang di upload harus .png, .jpg, jpeg',
                    'max_size' => 'Ukuran File terlalu besar, max_size 2048KB/2MB.',
                ]
            ],
            'nominal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nominal transfer harus di isi.'
                ]
            ],

        ])) {
            $no_trans = $this->request->getVar('no_trans');
            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/frontend/my_profile/konfirmasi_bayar/' . $no_trans)->withInput();
        }

        if ($this->request->getFile('bukti') != '') {

            $bukti = $this->request->getFile('bukti');
            $nominal = $this->request->getVar('nominal');
            $no_trans = $this->request->getVar('no_trans');
            $tgl = date("Y-m-d H:i:s");
            $a = $this->user_aktif();
            $nama_pelanggan = $a['nama_pel'];

            $nama_file = $bukti->getName();
            $save_dokumen = trim($nama_file);
            $bukti->move('assets/upload/bukti_transfer', $save_dokumen);
            $data = [
                'status_trans'     => 1,
                'bukti_trans'     => $save_dokumen,
                'nominal_transfer'     => $nominal,
                'tgl_konfirmasi'     => $tgl,
            ];

            $this->Front_mod->update_transaksi_pembayaran($data, $no_trans);
        }

        $this->konfirm_pembayaran($tgl, $no_trans, $nama_pelanggan, $nominal);

        return redirect()->to(base_url('/frontend/my_profile/pesananku'))->with('success', 'Konfirmasi pembayaran berhasil di kirim !<br> Pembayaran Anda akan di verifikasi terlebih dahulu');
    }

    function konfirm_pembayaran($tgl, $no_trans, $nama_pelanggan, $nominal)
    {
        $telegram_id = '-1001453263810';
        $message_text = '*>>>* _Konfirmasi pembayaran KitaGarut_ *<<<' . "*\n\n\n" . 'Waktu : ' . $tgl . ' ' . "\n" . 'No. Transaksi : * ' . $no_trans . ' ' . "*\n" . 'Nama Pelanggan  : *' . $nama_pelanggan . ' ' . "*\n" . 'Nominal Transfer : *' . rupiah($nominal) . '' . "*\n" . 'Status Transaksi  : *Menunggu Verifikasi Admin KitaGarut ' . "*\n\n\n*>>>* _Konfirmasi pembayaran KitaGarut_ *<<<*" . '';

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
    }

    public function detail_pesanan($inv)
    {
        if ($this->cek_login() == FALSE) {
            return redirect()->to(base_url('frontend/new_home/login'));
        }
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $detail_pesanan = $this->Front_mod->get_detail_pesananku($inv)->get()->getResultArray();

        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Detail Pesanan Saya',
            'user' => $this->user_aktif(),
            'kategori' => $kategori,
            'detail_pesanan' => $detail_pesanan,

            'cart' => \Config\Services::cart()
        ];
        return view('frontend/myprofile/detail_pesanan', $data);
    }
}
