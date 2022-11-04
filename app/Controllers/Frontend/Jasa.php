<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;
use App\Models\AkunModel;
use App\Models\JasaModel;

class Jasa extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->cek_login();
        $this->Front_mod = new FrontModel();
        $this->Akun_mod = new AkunModel();
        $this->Jasa_mod = new JasaModel();
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

        return view('frontend/jasa/index', $data);
    }

    public function all_jasa()

    {
        $pager = \Config\Services::pager();
        $db = db_connect();
        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();


        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $all_jasa = $this->Jasa_mod->search($keyword);
            $judul = 'Pencarian ' . $keyword;
            $submenu = 'Pencarian';
            $query   = $db->query("SELECT  COUNT(id_produk) AS jumlah FROM tbl_produk WHERE nama_produk like '%" . $keyword . "%'");
            $results = $query->getRowArray();
        } else {
            $all_jasa = $this->Jasa_mod;
            $judul = 'Semua Produk ';
            $submenu = 'Semua Produk';
            $query   = $db->query('SELECT  COUNT(id_jasa) AS jumlah FROM tbl_jasa');
            $results = $query->getRowArray();
        }
        $data = [
            'judul' => $judul,
            'menu' => 'KitaGarut',
            'submenu' => $submenu,
            'BestSeller' => $BestSeller,
            'all_jasa' => $all_jasa->orderBy('id_jasa', 'DESC')->paginate(12),
            'pager' => $all_jasa->pager,
            'kategori' => $kategori,
            'keyword' => $keyword,
            'numRows' => $results,
            'cart' => \Config\Services::cart(),
            'user' => $this->user_aktif(),
        ];

        return view('frontend/new/jasa/all_jasa', $data);
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


    public function singlejasa($slug)

    {
        $jasadetail = $this->Jasa_mod->getJasaById($slug)->get()->getRowArray();
        $namajasa = $jasadetail['nama_jasa'];
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $id_kat = $jasadetail['id_kat_jasa'];
        $id_sub_kat = $jasadetail['id_sub_kat_jasa'];
        $produk_samping = $this->Jasa_mod->getJasaSingle($id_sub_kat)->get()->getResultArray();
        $produk_samping2 = $this->Jasa_mod->getJasaSingle2($id_kat)->get()->getResultArray();

        $data = [
            'judul' => 'Single Produk',
            'menu' => 'KitaGarut',
            'submenu' => 'Single Produk',
            'jasadetail' => $jasadetail,
            'kategori' => $kategori,
            'slug' => $slug,
            'namajasa' => $namajasa,
            'produk_samping' => $produk_samping,
            'produk_samping2' => $produk_samping2,
            'user' => $this->user_aktif(),
            'cart' => \Config\Services::cart()
        ];


        return view('frontend/new/jasa/single-jasa', $data);
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
}
