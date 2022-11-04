<?php

namespace App\Controllers\Backend;

use App\Models\MasterModel;

class Master extends BaseController
{

    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->Master_mod = new MasterModel();
        $this->cek_login();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $merchant = $this->Master_mod->getMerchant();
        $user_aktif = $builder['id_peserta'];

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Merchant',
            'menu' => 'Master',
            'submenu' => 'Merchant',
            'user' => $builder,
            'merchant' => $merchant,
        ];
        return view('backend/master/index', $data);
    }

    function tambahMerchant()
    {
        $nama_toko = $this->request->getPost('nama_toko');
        $nama_seller = $this->request->getPost('nama_seller');
        $alamat_merchant = $this->request->getPost('alamat_merchant');
        $no_hp_merchant = $this->request->getPost('no_hp_merchant');
        $tgl_join = $this->request->getPost('tgl_join');
        $koordinat_merchant = $this->request->getPost('koordinat_merchant');

        $data = [
            'nama_seller'     => $nama_seller,
            'nama_toko'     => $nama_toko,
            'alamat_merchant'     => $alamat_merchant,
            'no_hp_merchant'     => $no_hp_merchant,
            'koordinat_merchant'     => str_replace(' ', '', $koordinat_merchant),
            'tgl_join'     => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_join))),
            'id_created'     => $this->request->getPost('id_login'),
            'date_updated'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Master_mod->tambahMerchant($data);
        return redirect()->to(base_url('/backend/master'))->with('success', 'Data Merchant berhasil di tambah !');
    }

    public function updateMerchant()
    {
        $nama_toko = $this->request->getPost('nama_toko2');
        $nama_seller = $this->request->getPost('nama_seller2');
        $alamat_merchant = $this->request->getPost('alamat_merchant2');
        $no_hp_merchant = $this->request->getPost('no_hp_merchant2');
        $tgl_join = $this->request->getPost('tgl_join2');
        $id_merchant = $this->request->getPost('id_merchant');
        $koordinat_merchant = $this->request->getPost('koordinat_merchant2');

        $data = [
            'nama_seller'     => $nama_seller,
            'nama_toko'     => $nama_toko,
            'alamat_merchant'     => $alamat_merchant,
            'no_hp_merchant'     => $no_hp_merchant,
            'koordinat_merchant'     => str_replace(' ', '', $koordinat_merchant),
            'tgl_join'     => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_join))),
            'id_created'     => $this->request->getPost('id_login2'),
            'date_updated'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Master_mod->updateMerchant($data, $id_merchant);
        return redirect()->to(base_url('/backend/master'))->with('success', 'Data Merchant berhasil di update !');
    }

    public function deleteMerchant()
    {
        $id = $this->request->getPost('id_merchant2');

        $this->Master_mod->deleteMerchant($id);
        return redirect()->to(base_url('/backend/master'))->with('success', 'Data Merchant berhasil di hapus !');
    }

    // <--------------------------------KATEGORI----------------------------------->

    public function kategori()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $kategori = $this->Master_mod->getKategori();
        $user_aktif = $builder['id_peserta'];

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Kategori Produk',
            'menu' => 'Master',
            'submenu' => 'Kategori Produk',
            'user' => $builder,
            'kategori' => $kategori,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/master/v_kategori', $data);
    }

    public function valid_kategori()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama_kat' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Kategori harus di isi.',
                    'min_length' => 'Minimal karakter adalah 5.',
                ]
            ],
        ])) {
            return $validation->listErrors();
        } else {
            $this->tambahKategori();
        }
    }

    function tambahKategori()
    {
        $nama_kat = $this->request->getPost('nama_kat');

        $data = [
            'nama_kat'     => $nama_kat,
            'id_user_kat'     => $this->request->getPost('id_login'),
            'date_updated'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Master_mod->tambahKategori($data);
        return redirect()->to(base_url('/backend/master/kategori'))->with('success', 'Data Kategori berhasil di tambah !');
    }

    public function updateKategori()
    {
        $nama_kat = $this->request->getPost('nama_kat2');
        $id_kat = $this->request->getPost('id_kat');

        $data = [
            'nama_kat'     => $nama_kat,
            'id_user_kat'     => $this->request->getPost('id_login'),
            'date_updated'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Master_mod->updateKategori($data, $id_kat);
        return redirect()->to(base_url('/backend/master/kategori'))->with('success', 'Data Kategori berhasil di update !');
    }

    public function deleteKategori()
    {
        $id = $this->request->getPost('id_kat2');

        $this->Master_mod->deleteKategori($id);
        return redirect()->to(base_url('/backend/master/kategori'))->with('success', 'Data Kategori berhasil di hapus !');
    }

    // <--------------------------------KATEGORI----------------------------------->

    public function subkategori()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('auth'));
        }

        $builder = $this->user_aktif();
        $kategori = $this->Master_mod->getSubKategori()->get()->getResultArray();
        $user_aktif = $builder['id_peserta'];

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Subkategori Produk',
            'menu' => 'Master',
            'submenu' => 'Subkategori Produk',
            'user' => $builder,
            'subkategori' => $kategori,
            'kategori' =>  $this->Master_mod->getKategori(),
        ];
        return view('backend/master/v_subkategori', $data);
    }

    function tambahSubKategori()
    {
        $nama_sub_kat = $this->request->getPost('nama_sub_kat');
        $id_kat_prod = $this->request->getPost('id_kat_prod');

        $data = [
            'nama_sub_kategori'     => $nama_sub_kat,
            'id_kat_s'     => $id_kat_prod,
        ];

        $this->Master_mod->tambahSubKategori($data);
        return redirect()->to(base_url('/backend/master/subkategori'))->with('success', 'Data SubKategori berhasil di tambah !');
    }

    public function updateSubKategori()
    {
        $id = $this->request->getPost('id_sub_kat');
        $nama_sub_kat = $this->request->getPost('nama_sub_kat2');
        $id_kat_prod = $this->request->getPost('id_kat_prod2');

        $data = [
            'nama_sub_kategori'     => $nama_sub_kat,
            'id_kat_s'     => $id_kat_prod,
        ];

        $this->Master_mod->updateSubKategori($data, $id);
        return redirect()->to(base_url('/backend/master/subkategori'))->with('success', 'Data SubKategori berhasil di update !');
    }

    public function deleteSubKategori()
    {
        $id = $this->request->getPost('id_sub_kat2');

        $db = db_connect();
        $cek = $db->table('tbl_produk')->getWhere(['id_sub_kat_prod' => $id])->getResultArray();
        $isi = count($cek);

        if ($isi > 0) {
            return redirect()->to(base_url('/backend/master/subkategori'))->with('gagal', 'Data SubKategori yang sudah berelasi dengan produk tidak bisa di hapus !');
        } else {

            $this->Master_mod->deleteSubKategori($id);
            return redirect()->to(base_url('/backend/master/subkategori'))->with('success', 'Data SubKategori berhasil di hapus !');
        }
    }

    // <--------------------------------PRODUK----------------------------------->

    public function produk()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();

        $produk = $this->Master_mod->get_produk()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Produk',
            'kategori' =>  $this->Master_mod->getKategori(),
            'user' => $builder,
            'produk' => $produk,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/master/v_produk', $data);
    }

    public function tambahProduk()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $produk = $this->Master_mod->get_produk()->get()->getResultArray();


        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Tambah Produk',
            'kategori' =>  $this->Master_mod->getKategori(),
            'subkategori' =>  $this->Master_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Master_mod->getMerchant(),
            'satuan' =>  $this->Master_mod->get_satuan(),
            'user' => $builder,
            'produk' => $produk,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/master/tambah_produk', $data);
    }

    function ambilSubKategori()
    {

        $category_id = $this->request->getPost('id');
        $data = $this->Master_mod->get_sub_category($category_id);
        echo json_encode($data);
    }

    function tambahProd()
    {
        if (!$this->validate([
            'foto_produk' => [
                'rules' => 'mime_in[foto_produk,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_produk,1024]|is_image[foto_produk]',
                'errors' => [
                    'is_image' => 'yang anda pilih bukan gambar.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'mime_in' => 'Ekstensi file harus .jpg, .jpeg, .png.'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Produk harus di isi.',
                ]
            ],
            'harga_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Harga Produk harus di isi.',
                ]
            ],
            'desc_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Deskripsi Produk harus di isi.'
                ]
            ],
            'id_kat_prod' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kategori Produk harus di isi.'
                ]
            ],
            'id_merchant_prod' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Merchant harus di isi.'
                ]
            ],
        ])) {

            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/backend/master/tambahProduk')->withInput();
        }

        // upload semua foto
        $files = $this->request->getFiles();
        foreach ($files['foto_produk'] as $img) {
            // upload dengan random name
            $img->move('assets/images/produk/');
        }
        //ambil nama foto ke database
        $jumlah = count($_FILES['foto_produk']['name']);
        if ($jumlah > 0) {
            $gambar = array();
            for ($i = 0; $i < $jumlah; $i++) {
                $file_name = $_FILES['foto_produk']['name'][$i];
                $gambar[$i] = $file_name;
            }
        }

        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $id = $this->request->getPost('id_buat');
        $nama_produk = $this->request->getVar('nama_produk');
        $SKU = $this->request->getVar('SKU');
        $desc_produk = $this->request->getVar('desc_produk');
        $harga_produk = $this->request->getVar('harga_produk');
        $harga_seller = $this->request->getVar('harga_seller');
        $berat_produk = $this->request->getVar('berat_produk');
        $expired = $this->request->getVar('expired');
        $satuan_produk = $this->request->getVar('satuan_produk');
        $id_kat_prod = $this->request->getVar('id_kat_prod');
        $id_sub_kat_prod = $this->request->getVar('id_sub_kat_prod');
        $komposisi = $this->request->getVar('komposisi');
        $id_merchant_prod = $this->request->getVar('id_merchant_prod');

        $data = [
            'nama_produk' => $nama_produk,
            'slug' => $slug,
            'SKU' => $SKU,
            'harga_seller' => $harga_seller,
            'berat_produk' => $berat_produk,
            'expired' => $expired,
            'satuan_produk' => $satuan_produk,
            'id_sub_kat_prod' => $id_sub_kat_prod,
            'harga_produk' => $harga_produk,
            'komposisi' => $komposisi,
            'desc_produk' => $desc_produk,
            'id_kat_prod' => $id_kat_prod,
            'id_merchant_prod' => $id_merchant_prod,
            'id_created' => $id,
            'date_created'     => date("Y-m-d\TH:i:s"),
            'foto_1' => $gambar[0],
            'foto_2' => ($jumlah > 1) ? $gambar[1] : '',
            'foto_3' => ($jumlah > 2) ? $gambar[2] : '',
            'foto_4' => ($jumlah > 3) ? $gambar[3] : '',
        ];

        $this->Master_mod->tambahProd($data);
        return redirect()->to(base_url('/backend/master/produk'))->with('success', 'Data Produk berhasil ditambah');
    }

    function get_edit($product_id)
    {
        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'product_id' => $product_id,
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Master_mod->getKategori(),
            'subkategori' =>  $this->Master_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Master_mod->getMerchant(),
            'satuan' =>  $this->Master_mod->get_satuan(),
            'user' => $this->user_aktif(),
            'produk' => $this->Master_mod->get_edit_produk($product_id)->get()->getRowArray(),
            'validation' => \Config\Services::validation(),
        ];
        $data['product_id'] = $product_id;
        $get_data = $this->Master_mod->getProdukById($product_id);
        if ($get_data->CountAllResults() > 0) {
            $row = $get_data->get()->getRowArray();
            $data['sub_category_id'] = $row['id_sub_kat_prod'];
        }
        return view('backend/master/update_prod', $data);
    }

    function get_data_edit()
    {
        $product_id = $this->request->getVar('product_id');
        $data = $this->Master_mod->getProdukById($product_id)->get()->getRowArray();
        echo json_encode($data);
    }

    public function updateProduk($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }
        $builder = $this->user_aktif();
        $produk = $this->Master_mod->get_edit_produk($id)->get()->getRowArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Master_mod->getKategori(),
            'subkategori' =>  $this->Master_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Master_mod->getMerchant(),
            'satuan' =>  $this->Master_mod->get_satuan(),
            'user' => $builder,
            'produk' => $produk,
            'id' => $id,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/master/update_prod', $data);
    }

    public function detailProduk($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $produk = $this->Master_mod->getProdukById($id)->get()->getRowArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Detail Produk',
            'menu' => 'Master',
            'submenu' => 'Detail Produk',
            'user' => $builder,
            'produk' => $produk,
            'id' => $id,
            'validation' => \Config\Services::validation(),
        ];

        return view('backend/master/detail_prod', $data);
    }

    public function deleteprod()
    {
        $id = $this->request->getPost('id_produk2');

        $this->Master_mod->deleteprod($id);
        return redirect()->to(base_url('/backend/master/produk'))->with('success', 'Data produk berhasil di hapus !');
    }
}
