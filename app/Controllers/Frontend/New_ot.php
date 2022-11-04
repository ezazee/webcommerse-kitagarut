<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;

class New_home extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->cek_login();
        $this->Front_mod = new FrontModel();
        ini_set('max_execution_time', 300);
    }

    public function index()

    {
        $produkTerbaru = $this->Front_mod->getProdukTerbaru()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();

        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'KitaGarut',
            'produkTerbaru' => $produkTerbaru,
            'all_produk' => $this->Front_mod->getAllProduk()->get()->getResultArray(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart(),
            'user' => $this->user_aktif(),
        ];

        return view('frontend/new/index', $data);
    }

    public function all_produk()

    {
        $pager = \Config\Services::pager();
        $db = db_connect();
        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();


        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $all_produk = $this->Front_mod->search($keyword);
            $judul = 'Pencarian ' . $keyword;
            $submenu = 'Pencarian';
            $query   = $db->query("SELECT  COUNT(id_produk) AS jumlah FROM tbl_produk WHERE nama_produk like '%" . $keyword . "%'");
            $results = $query->getRowArray();
        } else {
            $all_produk = $this->Front_mod;
            $judul = 'Semua Produk ';
            $submenu = 'Semua Produk';
            $query   = $db->query('SELECT  COUNT(id_produk) AS jumlah FROM tbl_produk');
            $results = $query->getRowArray();
        }
        $data = [
            'judul' => $judul,
            'menu' => 'KitaGarut',
            'submenu' => $submenu,
            'BestSeller' => $BestSeller,
            'all_produk' => $all_produk->orderBy('a.id_produk', 'RANDOM')->paginate(12),
            'pager' => $all_produk->pager,
            'kategori' => $kategori,
            'keyword' => $keyword,
            'numRows' => $results,
            'cart' => \Config\Services::cart(),
            'user' => $this->user_aktif(),
        ];

        return view('frontend/new/all_produk2', $data);
    }

    public function produkKategori($id)

    {
        $pager = \Config\Services::pager();

        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $db = db_connect();
        $query   = $db->query('SELECT  COUNT(id_kat_prod) AS jumlah FROM tbl_produk WHERE id_kat_prod = ' . $id . '');
        $results = $query->getRowArray();

        $data = [
            'judul' => 'Kategori ',
            'menu' => 'KitaGarut',
            'submenu' => 'Kategori',
            'BestSeller' => $BestSeller,
            'produk_kategori' => $this->Front_mod->orderBy('a.id_produk', 'RANDOM')->where('id_kat_prod', $id)->paginate(12),
            'pager' => $this->Front_mod->pager,
            'kategori' => $kategori,
            'id' => $db->table('tbl_kategori')->getWhere(['id_kat' => $id])->getRowArray(),
            'numRows' => $results,
            'user' => $this->user_aktif(),
            'cart' => \Config\Services::cart()

        ];

        return view('frontend/new/produk_kategori', $data);
    }


    public function singleProduk($id)

    {
        $produkdetail = $this->Front_mod->getProdukById($id)->get()->getRowArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $id_kat = $produkdetail['id_kat_prod'];
        $id_sub_kat = $produkdetail['id_sub_kat_prod'];
        $produk_samping = $this->Front_mod->getProdukSingle($id_sub_kat)->get()->getResultArray();
        $produk_samping2 = $this->Front_mod->getProdukSingle2($id_kat)->get()->getResultArray();


        $data = [
            'judul' => 'Single Produk',
            'menu' => 'KitaGarut',
            'submenu' => 'Single Produk',
            'produkdetail' => $produkdetail,
            'kategori' => $kategori,
            'produk_samping' => $produk_samping,
            'produk_samping2' => $produk_samping2,
            'user' => $this->user_aktif(),
            'cart' => \Config\Services::cart()
        ];


        return view('frontend/new/single-produk', $data);
    }


    public function tambah_cart_qty()
    {
        $cart = \Config\Services::cart();
        $id = $this->request->getVar('id');

        $keranjang = $cart->contents();

        if ($keranjang != null) {
            session()->setFlashdata('pesan', 'sudah ada produk pada keranjang anda .<br> harap checkout terlebih dahulu .');
            return redirect()->to('/frontend/new_home/load_cart');
        } else {

            $cart->insert(array(
                'id'      => $id,
                'qty'     => $this->request->getVar('qty'),
                'price'   => $this->request->getVar('price'),
                'name'    => $this->request->getVar('name'),
                'options' => array(
                    'foto_1' => $this->request->getVar('foto_1'),
                    'harga_produk' => $this->request->getVar('harga_produk'),
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'berat_produk' => $this->request->getVar('berat_produk'),
                    'id_merchant' => $this->request->getVar('id_merchant'),
                )
            ));

            session()->setFlashdata('success', 'Produk berhasil di masukan ke keranjang');
            return redirect()->to('/frontend/new_home/load_cart');
        }
    }

    public function beli_sekarang()
    {
        $cart = \Config\Services::cart();
        $id = $this->request->getVar('id');
        $cart->insert(array(
            'id'      => $id,
            'qty'     => $this->request->getVar('qty'),
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
            'options' => array(
                'foto_1' => $this->request->getVar('foto_1'),
                'harga_produk' => $this->request->getVar('harga_produk'),
                'nama_merchant' => $this->request->getVar('nama_merchant'),
            )
        ));

        session()->setFlashdata('pesan', 'Produk berhasil di masukan ke keranjang');
        return redirect()->to('/frontend/new_home/pesananku');
    }

    public function clear_cart()
    {
        // Clear the shopping cart
        $cart = \Config\Services::cart();
        $cart->destroy();

        session()->setFlashdata('pesan', 'Keranjang berhasil di kosongkan');
        return redirect()->to('/frontend/new_home/load_cart');
    }


    function load_cart()
    {
        $cart = \Config\Services::cart();

        $keranjang = $cart->contents();

        $data = [
            'judul' => 'Keranjang Belanja',
            'menu' => 'KitaGarut',
            'submenu' => 'Keranjang Belanja',
            'user' => $this->user_aktif(),
            'keranjang' => $keranjang,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'user' => $this->user_aktif(),
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/my_cart', $data);
    }

    function checkout()
    {

        if ($this->user_aktif() != null) {
            $builder = $this->user_aktif();
        } else {
            return redirect()->to(base_url('/frontend/new_home/login'))->with('gagal', 'Untuk melakukan Pemesanan Anda harus Login ! <br> Jika Anda belum mempunyai akun KitaGarut Silahkan Daftar terlebih dahulu .');
        }
        $cart = \Config\Services::cart();

        $keranjang = $cart->contents();

        $data = [
            'judul' => 'Keranjang Belanja',
            'menu' => 'KitaGarut',
            'submenu' => 'Keranjang Belanja',
            'keranjang' => $keranjang,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'user' => $builder,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/checkout', $data);
    }

    function konfirmasi_pesanan()
    {
        if ($this->user_aktif() != null) {
            $builder = $this->user_aktif();
        } else {
            return redirect()->to(base_url('/frontend/new_home/login'))->with('gagal', 'Untuk melakukan Pemesanan Anda harus Login ! <br> Jika Anda belum mempunyai akun KitaGarut Silahkan Daftar terlebih dahulu .');
        }

        $lat = $this->request->getVar('lat_input');
        $lon = $this->request->getVar('lon_input');
        $latlon = $lat . ',' . $lon;

        if (empty($lat)) {
            return redirect()->to(base_url('/frontend/new_home/checkout'))->with('gagal', 'Koordinat pengiriman tidak valid .<br> Ulangi pemilihan lokasi pada Peta');
        }
        $cart = \Config\Services::cart();

        $keranjang = $cart->contents();

        foreach ($keranjang as $key => $value) :
            $ini = [
                'id_merchant' => $value['options']['id_merchant'],
            ];

        endforeach;
        $id_merchant = $ini;
        $db = db_connect();
        $merchant = $db->table('tbl_merchant')->getWhere(['id_merchant' => $id_merchant])->getRowArray();
        $koordinat = $merchant['koordinat_merchant'];
        $data = [
            'judul' => 'Keranjang Belanja',
            'menu' => 'KitaGarut',
            'submenu' => 'Keranjang Belanja',
            'keranjang' => $keranjang,
            'koordinat_merchant' => $koordinat,
            'latlon' => $latlon,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'user' => $builder,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/konfirmasi_pesanan', $data);
    }

    function buy_now()
    {
        $cart = \Config\Services::cart();

        $keranjang = $cart->contents();

        $data = [
            'judul' => 'Keranjang Belanja',
            'menu' => 'KitaGarut',
            'submenu' => 'Keranjang Belanja',
            'user' => $this->user_aktif(),
            'keranjang' => $keranjang,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'user' => $this->user_aktif(),
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/my_cart', $data);
    }

    function sketentuan()
    {
        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'user' => $this->user_aktif(),
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'cart' => \Config\Services::cart()
        ];


        return view('frontend/home/s&k', $data);
    }


    public function hapus_cart($rowid)
    {
        // Clear the shopping cart
        $cart = \Config\Services::cart();
        $cart->remove($rowid);

        session()->setFlashdata('pesan', 'Produk berhasil di hapus dari keranjang');
        return redirect()->to('/frontend/new_home/load_cart');
    }

    public function kontak()
    {
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Kontak',
            'user' => $this->user_aktif(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()
        ];
        return view('frontend/new/v_kontak', $data);
    }

    public function syaratketentuan()
    {
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Syarat & Ketentuan',
            'user' => $this->user_aktif(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()
        ];
        return view('frontend/new/syaratketentuan', $data);
    }

    public function proses_register()
    {

        if (!$this->validate([
            'email_pel' => [
                'rules' => 'required|valid_email|is_unique[tbl_pelanggan.email_pel]',
                'errors' => [
                    'valid_email' => 'Email yang anda masukan tidak valid.',
                    'required' => 'Kolom Email harus di isi.',
                    'is_unique' => 'Email yang Anda Masukan sudah terdaftar pada sistem kami.',
                ]
            ],
            'nama_pel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama harus di isi.',
                ]
            ],
            'no_hp_pel' => [
                'rules' => 'required|min_length[10]|is_unique[tbl_pelanggan.no_hp_pel]',
                'errors' => [
                    'required' => 'Kolom No Hp harus di isi.',
                    'min_length' => 'No.hp Minimal 10 karakter.',
                    'is_unique' => 'No Handphone yang Anda Masukan sudah terdaftar pada sistem kami.',
                ]
            ],
            'alamat_pel' => [
                'rules' => 'required|min_length[35]',
                'errors' => [
                    'required' => 'Kolom Alamat harus di isi.',
                    'min_length' => 'Alamat Minimal 35 karakter.',
                ]
            ],
            'password1' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Kolom Password harus di isi.',
                    'min_length' => 'Password Minimal 8 karakter.',
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password1]|min_length[8]',
                'errors' => [
                    'required' => 'Kolom konfirmasi Password harus di isi.',
                    'matches' => 'Kolom konfirmasi Password harus sama dengan password.',
                    'min_length' => 'Password Minimal 8 karakter.',
                ]
            ],

        ])) {

            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/frontend/new_home/login#register')->withInput();
        }

        $nama_pel = $this->request->getPost('nama_pel');
        $no_hp_pel = nomer_hp($this->request->getPost('no_hp_pel'));

        $data = [
            'email_pel'             => $this->request->getPost('email_pel'),
            'nama_pel'              => $nama_pel,
            'alamat_pel'              => $this->request->getPost('alamat_pel'),
            'no_hp_pel'          => $no_hp_pel,
            'password'          => password_hash($this->request->getPost('password1'), PASSWORD_DEFAULT),
            'date_created'          => date("Y-m-d H:i:s"),
            'foto_pel'          => 'default.jpg',
            'is_active'          => 0
        ];

        $this->Front_mod->register($data);

        $this->send_otp_wa($nama_pel, $no_hp_pel);

        return redirect()->to(base_url('/frontend/new_home/masukan_otp/' . $no_hp_pel))->with('success', 'Pendaftaran Berhasil, Silahkan Masukan kode OTP');
    }

    public function aktifasi()
    {
        if ($this->cek_login() == TRUE) {
            return redirect()->to(base_url('frontend/new_home/all_produk'));
        }

        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();

        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Aktifasi Akun',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/v_aktifasi', $data);
    }

    public function masukan_otp($no_hp_pel)
    {
        if ($this->cek_login() == TRUE) {
            return redirect()->to(base_url('frontend/new_home/all_produk'));
        }

        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Masukan OTP',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'no_hp_pel' => $no_hp_pel,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/v_aktifasi_otp', $data);
    }

    public function aktifasi_otp()
    {
        if ($this->cek_login() == TRUE) {
            return redirect()->to(base_url('frontend/new_home/all_produk'));
        }

        if (!$this->validate([
            'no_hp_pel' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Kolom No Hp harus di isi.',
                    'min_length' => 'No.hp Minimal 10 karakter.',
                ]
            ],


        ])) {

            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/frontend/new_home/aktifasi')->withInput();
        }

        $hp = $this->request->getVar('no_hp_pel');
        $no_hp_pel = nomer_hp($hp);


        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Masukan OTP',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/new/v_aktifasi_otp', $data);
    }

    public function send_aktifasi_otp($no_hp_pel)
    {
        $to      = $no_hp_pel;
        $otp     = rand(100000, 999999);
        $message = "KitaGarut.com" . "\n\n" . "Selamat bergabung, " . "\n\n" . $no_hp_pel . "\n\n" . "OTP Anda : " . $otp . "\n";
        $url     = 'https://wa.alim.my.id/send';
        $header  = array(
            'Content-Type: application/json',
        );
        $params = [
            'type' => 'text',
            'to'      => $to,
            'message' => $message,
        ];


        $insertdb = [
            "nomer" => $no_hp_pel,
            "otp" => $otp,
            "waktu" => date('Y-m-d H:i:s')
        ];

        $cek_otp = $this->Front_mod->cek_otp($no_hp_pel);
        if ($cek_otp > 0) {
            $this->Front_mod->delete_otp($no_hp_pel);
        }
        $this->Front_mod->insert_otp($insertdb);

        $params_post = json_encode($params, JSON_PRETTY_PRINT);
        $post        = curl_init($url);

        curl_setopt($post, CURLOPT_HTTPHEADER, $header);
        curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($post);
        curl_close($post);
        return $response;
    }

    public function validasi_otp()

    {
        $otp = $this->request->getPost('otp');
        $no_hp_pel = $this->request->getPost('no_hp_pel');

        $no_hp = $this->Front_mod->validasi_otp($no_hp_pel);

        // jika usernya ada
        if ($no_hp) {
            // jika usernya aktif
            if ($no_hp['otp'] == $otp) {
                $db = db_connect();
                $builder = $db->table('tbl_pelanggan');
                $builder->set('is_active', 1);
                $builder->where('no_hp_pel', $no_hp_pel);
                $builder->update();

                session()->setFlashdata('success', 'OTP berhasil, Akun Anda sudah Aktif ! <br> Silahkan Login');
                return redirect()->to('/frontend/new_home/login');
            } else {
                session()->setFlashdata('gagal', 'OTP tidak Valid');
                return redirect()->to('/frontend/new_home/masukan_otp/' . $no_hp_pel);
            }
        } else {
            session()->setFlashdata('gagal', 'Nomor Anda belum melakukan OTP');
            return redirect()->to('/frontend/new_home/login');
        }
    }

    public function send_otp_wa($nama_pel, $no_hp_pel)
    {

        $to      = $no_hp_pel;
        $otp     = rand(100000, 999999);
        $message = "KitaGarut.com" . "\n\n" . "Selamat bergabung, " . "\n\n" . $nama_pel . "\n\n" . "OTP Anda : " . $otp . "\n";
        $url     = 'https://wa.alim.my.id/send';
        $header  = array(
            'Content-Type: application/json',
        );
        $params = [
            'type' => 'text',
            'to'      => $to,
            'message' => $message,
        ];

        $params_post = json_encode($params, JSON_PRETTY_PRINT);
        $post        = curl_init($url);

        curl_setopt($post, CURLOPT_HTTPHEADER, $header);
        curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($post);
        curl_close($post);

        $insertdb = [
            "nomer" => $no_hp_pel,
            "otp" => $otp,
            "waktu" => date('Y-m-d H:i:s')
        ];

        $cek_otp = $this->Front_mod->cek_otp($no_hp_pel);
        if ($cek_otp > 0) {
            $this->Front_mod->delete_otp($no_hp_pel);
        }
        $this->Front_mod->insert_otp($insertdb);

        return $response;
    }

    public function login()
    {
        if ($this->cek_login() == TRUE) {

            return redirect()->to(base_url('frontend/new_home/all_produk'));
        }

        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'Login/Register',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()
        ];
        return view('frontend/new/v_login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/frontend/new_home/login');
    }

    public function check_login()

    {
        $email = $this->request->getPost('email_pel');
        $password = $this->request->getPost('password');

        $user = $this->Front_mod->check_login($email);
        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email_pel' => $user['email_pel'],
                        'nama_pel' => $user['nama_pel'],
                        'id_pel' => $user['id_pel'],
                    ];
                    session()->set($data);

                    return redirect()->to('/frontend/new_home/load_cart');
                } else {
                    session()->setFlashdata('gagal', 'Password yang Anda masukan salah !');
                    return redirect()->to('/frontend/new_home/login')->withInput();
                }
            } else {
                session()->setFlashdata('gagal', 'Akun Anda belum aktif ! <br> belum melakukan OTP Whatsapp');
                return redirect()->to('/frontend/new_home/login')->withInput();
            }
        } else {
            session()->setFlashdata('gagal', 'Email tidak terdaftar !');
            return redirect()->to('/frontend/new_home/login')->withInput();
        }
    }

    public function simpan_penjualan()
    {
        $keranjang = \Config\Services::cart();

        if ($this->user_aktif() != null) {
            $builder = $this->user_aktif();
        } else {
            return redirect()->to(base_url('/frontend/new_home/login'))->with('gagal', 'Untuk melakukan Pemesanan Anda harus Login ! <br> Jika Anda belum mempunyai akun KitaGarut Silahkan Daftar terlebih dahulu .');
        }

        $lat = $this->request->getPost('lat');
        $latlon = preg_replace("/[LatLng() ]/", "", $lat);
        $latlon_merchant = $this->request->getPost('koordinat_merchant');
        $koordinat = "https://www.google.com/maps/search/?api=1&query=$latlon";
        $koordinat_merchant = "https://www.google.com/maps/search/?api=1&query=$latlon_merchant";
        $ongkir_input = $this->request->getPost('ongkir_input');
        $metode_bayar = $this->request->getPost('metode_bayar');

        $jarak_input = $this->request->getPost('jarak_input');
        $total_belanja_ongkir = $this->request->getPost('total_input');
        $total_belanja = $this->request->getPost('total_i');
        $no_trans = $this->Front_mod->get_no_invoice();
        $tgl = date("Y-m-d H:i:s");
        $nama_pelanggan = $builder['nama_pel'];

        if ($metode_bayar == 'COD') {

            $data = [
                'no_trans'             =>    $no_trans,
                'tgl_trans'             =>    date("Y-m-d"),
                'ongkir_trans'             =>    $ongkir_input,
                'metode_bayar'             =>    $metode_bayar,
                'jarak_trans'             =>    $jarak_input,
                'total_belanja_ongkir'             =>    $total_belanja_ongkir,
                'total_belanja'             =>    $total_belanja,
                'koordinat'             =>    $koordinat,
                'koordinat_merchant'             =>    $koordinat_merchant,
                'id_pelanggan_trans'             =>    $builder['id_pel'],
                'status_bayar'             =>    0,
                'status_trans'             =>    2,
                'date_created'          => $tgl,
            ];
            $this->Front_mod->simpan_transaksi($data);
        } else {

            $data = [
                'no_trans'             =>    $no_trans,
                'tgl_trans'             =>    date("Y-m-d"),
                'ongkir_trans'             =>    $ongkir_input,
                'metode_bayar'             =>    $metode_bayar,
                'jarak_trans'             =>    $jarak_input,
                'total_belanja_ongkir'             =>    $total_belanja_ongkir,
                'total_belanja'             =>    $total_belanja,
                'koordinat'             =>    $koordinat,
                'koordinat_merchant'             =>    $koordinat_merchant,
                'id_pelanggan_trans'             =>    $builder['id_pel'],
                'status_bayar'             =>    0,
                'status_trans'             =>    0,
                'date_created'          => $tgl,
            ];
            $this->Front_mod->simpan_transaksi($data);
        }

        if ($cart = $keranjang->contents()) :
            foreach ($cart as $key => $value) :
                $data2 = [
                    'no_trns'             =>    $no_trans,
                    'id_prod_trns'             =>    $value['id'],
                    'nama_produk_trns'             =>    $value['name'],
                    'qty_trns'             =>    $value['qty'],
                    'harga_jual'             =>    $value['price'],
                    'subtotal'             =>    $value['subtotal'],
                    'nama_merchant'             =>    $value['options']['nama_merchant'],
                    'harga_modal'             =>    $value['options']['harga_produk'],
                ];
                $this->Front_mod->simpan_detail_transaksi($data2);

            endforeach;
        endif;

        $keranjang->destroy();

        $this->sendMessage($tgl, $no_trans, $nama_pelanggan, $ongkir_input, $total_belanja, $total_belanja_ongkir, $metode_bayar, $koordinat_merchant, $koordinat);

        return redirect()->to(base_url('/frontend/new_home/pesananku'))->with('success', 'Checkout Berhasil, Silahkan lakukan Pembayaran ');
    }

    function sendMessage($tgl, $no_trans, $nama_pelanggan, $ongkir_input, $total_belanja, $total_belanja_ongkir, $metode_bayar, $koordinat_merchant, $koordinat)
    {
        $telegram_id = '-424167559';
        $message_text = 'Waktu : ' . $tgl . ' ' . "\n" . 'No. Transaksi : * ' . $no_trans . ' ' . "*\n" . 'Nama Pelanggan  : *' . $nama_pelanggan . ' ' . "*\n" . 'Total Pembelian : *' . rupiah($total_belanja) . ' ' . "*\n" . 'Ongkir : *' . rupiah($ongkir_input) . ' ' . "*\n" . 'Total Pembayaran : *' . rupiah($total_belanja_ongkir) . ' ' . "*\n" . 'Metode Pembayaran : *' . $metode_bayar . ' ' . "*\n" . 'Lokasi Merchant : *' . $koordinat_merchant . ' ' . "*\n" . 'Lokasi Konsumen : *' . $koordinat . ' ' . "*\n\n\n*>>>* _Laporan Transaksi KitaGarut_ *<<<*" . '';

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
        return view('frontend/new/v_pesanan_saya', $data);
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
        return view('frontend/new/v_detail_pesanan', $data);
    }

    public function v_konfirmasi($inv)
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
        return view('frontend/new/konfirmasi_bayar', $data);
    }

    public function konfirmasi_bayar()
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
            return redirect()->to('/frontend/new_home/v_konfirmasi/' . $no_trans)->withInput();
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

        return redirect()->to(base_url('/frontend/new_home/pesananku'))->with('success', 'Konfirmasi pembayaran berhasil di kirim !<br> Pembayaran Anda akan di verifikasi terlebih dahulu');
    }

    function konfirm_pembayaran($tgl, $no_trans, $nama_pelanggan, $nominal)
    {
        $telegram_id = '-424167559';
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

    public function otp_wa()
    {
        $to      = '6285156780115';
        $otp     = 158969;
        $message = $otp . " - OTP untuk login kedalam sistem";
        $url     = 'https://wa.alim.my.id/send';
        $header  = array(
            'Content-Type: application/json',
        );
        $params = [
            'to'      => $to,
            'messages' => $message,
        ];
        $params_post = json_encode($params, JSON_PRETTY_PRINT);
        $post        = curl_init($url);

        curl_setopt($post, CURLOPT_HTTPHEADER, $header);
        curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($post);
        curl_close($post);
        echo $response;
    }

    public function otp_baru()
    {
        $to      = '6289697161692';
        $otp     = rand(100000, 999999);
        $message = "KitaGarut.com" . "\n\n" . "Selamat bergabung, " . "\n\n" . 'Bosque' . "\n\n" . "OTP Anda : " . $otp . "\n";
        $url     = 'https://wa.alim.my.id/send';
        $header  = array(
            'Content-Type: application/json',
        );
        $params = [
            'type' => 'text',
            'to'      => $to,
            'message' => $message,
        ];

        $params_post = json_encode($params, JSON_PRETTY_PRINT);
        $post        = curl_init($url);

        curl_setopt($post, CURLOPT_HTTPHEADER, $header);
        curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($post);
        curl_close($post);
        echo $response;
    }
}
