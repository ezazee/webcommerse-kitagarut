<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;

class Home extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->cek_login();
        $this->Front_mod = new FrontModel();
    }

    public function index()

    {
        $produkTerbaru = $this->Front_mod->getProdukTerbaru()->get()->getResultArray();
        $produk_kebun = $this->Front_mod->getProdukKebun()->get()->getResultArray();
        $produk_kerajinan = $this->Front_mod->getProdukKerajinan()->get()->getResultArray();
        $produk_ternak = $this->Front_mod->getProdukTernak()->get()->getResultArray();
        $produk_kuliner = $this->Front_mod->getProdukKuliner()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();

        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'produkTerbaru' => $produkTerbaru,
            'all_produk' => $this->Front_mod->getAllProduk()->get()->getResultArray(),
            'produk_kebun' => $produk_kebun,
            'produk_kerajinan' => $produk_kerajinan,
            'produk_ternak' => $produk_ternak,
            'produk_kuliner' => $produk_kuliner,
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()

        ];

        return view('frontend/home/index', $data);
    }

    public function all_produk()

    {
        $pager = \Config\Services::pager();

        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();



        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'BestSeller' => $BestSeller,
            'all_produk' => $this->Front_mod->paginate(9),
            'pager' => $this->Front_mod->pager,
            'kategori' => $kategori,
            'cart' => \Config\Services::cart()

        ];

        return view('frontend/home/semua_produk', $data);
    }

    public function produkKategori($id)

    {
        $pager = \Config\Services::pager();

        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();

        $db = db_connect();
        $builder = $db->table('tbl_peserta')->getWhere(['email_peserta' => session()->get('email')])->getRowArray();

        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'BestSeller' => $BestSeller,
            'produk_kategori' => $this->Front_mod->where('id_kat_prod', $id)->paginate(9),
            'pager' => $this->Front_mod->pager,
            'kategori' => $kategori,
            'id' => $db->table('tbl_kategori')->getWhere(['id_kat' => $id])->getRowArray(),
            'cart' => \Config\Services::cart()

        ];

        return view('frontend/home/produk_kategori', $data);
    }

    public function produkSearch()

    {
        $pager = \Config\Services::pager();

        $search = $this->request->getVar('search');


        $BestSeller = $this->Front_mod->getBestSeller()->get()->getResultArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();

        $db = db_connect();
        $builder = $db->table('tbl_peserta')->getWhere(['email_peserta' => session()->get('email')])->getRowArray();

        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'BestSeller' => $BestSeller,
            'all_produk' => $this->Front_mod->like('nama_produk', $search)->paginate(9),
            'pager' => $this->Front_mod->like('nama_produk', $search)->pager,
            'kategori' => $kategori,
            'search' => $search,
            'cart' => \Config\Services::cart()

        ];

        return view('frontend/home/cari_produk', $data);
    }

    public function produkDetail($id)

    {
        $produkdetail = $this->Front_mod->getProdukById($id)->get()->getRowArray();
        $kategori = $this->Front_mod->getKategori()->get()->getResultArray();
        $id_kat = $produkdetail['id_kat_prod'];
        $produk_samping = $this->Front_mod->getProdukSingle($id_kat)->get()->getResultArray();

        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'produkdetail' => $produkdetail,
            'kategori' => $kategori,
            'produk_samping' => $produk_samping,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/home/produk_detail', $data);
    }

    public function tampil_cart()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        $data = json_encode($response);
        dd($data);
    }
    public function tambah_cart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getVar('id'),
            'qty'     => 1,
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
            'options' => array('foto_1' => $this->request->getVar('foto_1'), 'kategori' => $this->request->getVar('kategori'))
        ));
        session()->setFlashdata('pesan', 'Produk berhasil di masukan ke keranjang');
        return redirect()->to('/frontend/home/load_cart');
    }

    public function tambah_cart_qty()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getVar('id'),
            'qty'     => $this->request->getVar('qty'),
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
            'options' => array('foto_1' => $this->request->getVar('foto_1'), 'kategori' => $this->request->getVar('kategori'))
        ));
        session()->setFlashdata('pesan', 'Produk berhasil di masukan ke keranjang');
        return redirect()->to('/frontend/home/load_cart');
    }

    public function clear_cart()
    {
        // Clear the shopping cart
        $cart = \Config\Services::cart();
        $cart->destroy();
    }



    function show_cart()
    {
        $cart = \Config\Services::cart();
        $output = '';
        $no = 0;
        foreach ($cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td>' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">' . 'Rp ' . number_format($cart->total()) . '</th>
            </tr>
        ';
        return $output;
    }

    function load_cart()
    {
        $cart = \Config\Services::cart();
        $keranjang = $cart->contents();
        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
            'keranjang' => $keranjang,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'cart' => \Config\Services::cart()
        ];


        return view('frontend/home/my_cart', $data);
    }

    function sketentuan()
    {

        $data = [
            'judul' => 'Rencana Kerja',
            'menu' => 'Rencana Kerja',
            'submenu' => 'Rencana Kerja',
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
        return redirect()->to('/frontend/home/load_cart');
    }
}
