<?php

namespace App\Controllers\Backend;

use App\Models\MitrakgModel;
use App\Models\AkunModel;

class Mitrakg extends BaseController
{

    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->Mitrakg_mod = new MitrakgModel();
        $this->Akun_mod = new AkunModel();
        $this->cek_login();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $id_mitra = $builder['id_mitra_pes'];
        $merchant = $this->Mitrakg_mod->getMerchant($id_mitra)->get()->getResultArray();

        $user_aktif = $builder['id_peserta'];

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Merchant OkeOce Milegar',
            'menu' => 'Mitra KG',
            'submenu' => 'Merchant OkeOce Milegar',
            'user' => $builder,
            'merchant' => $merchant,
        ];
        return view('backend/mitrakg/index', $data);
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

    public function view_tambah_produk()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $provinsi = $this->Akun_mod->get_provinsi()->getResult();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Tambah Merchant',
            'menu' => 'Mitra KG',
            'submenu' => 'Tambah Merchant',
            'provinsi' => $provinsi,
            'user' => $builder,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/mitrakg/tambah_merchant', $data);
    }

    function tambahMerchant()
    {
        $no_ktp = $this->request->getPost('no_ktp');
        $nama_toko = $this->request->getPost('nama_toko');
        $nama_seller = $this->request->getPost('nama_seller');
        $alamat_merchant = $this->request->getPost('alamat_merchant');
        $no_hp_merchant = $this->request->getPost('no_hp_merchant');
        $tgl_join = $this->request->getPost('tgl_join');
        $koordinat_merchant = $this->request->getPost('koordinat_merchant');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $kecamatan = $this->request->getPost('kecamatan');
        $id_mitra_merchant = $this->request->getPost('id_mitra_merchant');

        $data = [
            'no_ktp'     => $no_ktp,
            'id_mitra_merchant'     => $id_mitra_merchant,
            'provinsi_merchant'     => $provinsi,
            'kota_merchant'     => $kota,
            'kecamatan_merchant'     => $kecamatan,
            'nama_seller'     => $nama_seller,
            'nama_toko'     => $nama_toko,
            'alamat_merchant'     => $alamat_merchant,
            'no_hp_merchant'     => $no_hp_merchant,
            'koordinat_merchant'     => str_replace(' ', '', $koordinat_merchant),
            'tgl_join'     => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_join))),
            'id_created'     => $this->request->getPost('id_created'),
            'date_updated'     => date("Y-m-d\ H:i:s"),
        ];

        $this->Mitrakg_mod->tambahMerchant($data);
        return redirect()->to(base_url('/backend/mitrakg'))->with('success', 'Data Merchant berhasil di tambah !');
    }

    function get_data_edit_merchant()
    {
        $id_merchant = $this->request->getVar('id_merchant');
        $data = $this->Mitrakg_mod->getProdukById($id_merchant)->get()->getRowArray();
        echo json_encode($data);
    }

    public function updatemerchant($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }
        $builder = $this->user_aktif();
        $merchant = $this->Mitrakg_mod->get_edit_merchant($id)->get()->getRowArray();
        $provinsi = $this->Akun_mod->get_provinsi()->getResult();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Merchant',
            'menu' => 'Master',
            'submenu' => 'Update Merchant',
            'user' => $builder,
            'provinsi' => $provinsi,
            'merchant' => $merchant,
            'id' => $id,
            'validation' => \Config\Services::validation(),
        ];

        return view('backend/mitrakg/edit_merchant', $data);
    }

    public function update_merchant_act()
    {
        $id_merchant = $this->request->getVar('id_merchant');
        $no_ktp = $this->request->getPost('no_ktp');
        $nama_toko = $this->request->getPost('nama_toko');
        $nama_seller = $this->request->getPost('nama_seller');
        $alamat_merchant = $this->request->getPost('alamat_merchant');
        $no_hp_merchant = $this->request->getPost('no_hp_merchant');
        $tgl_join = $this->request->getPost('tgl_join');
        $koordinat_merchant = $this->request->getPost('koordinat_merchant');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $kecamatan = $this->request->getPost('kecamatan');
        $id_mitra_merchant = $this->request->getPost('id_mitra_merchant');

        $data = [
            'no_ktp'     => $no_ktp,
            'id_mitra_merchant'     => $id_mitra_merchant,
            'provinsi_merchant'     => $provinsi,
            'kota_merchant'     => $kota,
            'kecamatan_merchant'     => $kecamatan,
            'nama_seller'     => $nama_seller,
            'nama_toko'     => $nama_toko,
            'alamat_merchant'     => $alamat_merchant,
            'no_hp_merchant'     => $no_hp_merchant,
            'koordinat_merchant'     => str_replace(' ', '', $koordinat_merchant),
            'tgl_join'     => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_join))),
            'id_created'     => $this->request->getPost('id_created'),
            'date_updated'     => date("Y-m-d\ H:i:s"),
        ];


        $this->Mitrakg_mod->updateMerchant($data, $id_merchant);
        return redirect()->to(base_url('/backend/mitrakg'))->with('success', 'Data Merchant berhasil di update !');
    }

    public function deleteMerchant()
    {
        $id = $this->request->getPost('id_merchant2');

        $this->Mitrakg_mod->deleteMerchant($id);
        return redirect()->to(base_url('/backend/mitrakg'))->with('success', 'Data Merchant berhasil di hapus !');
    }

    // <--------------------------------PRODUK----------------------------------->

    public function produk()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $id_mitra = $builder['id_mitra_pes'];
        $produk = $this->Mitrakg_mod->get_produk($id_mitra)->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Mitra KG',
            'submenu' => 'Produk',
            'kategori' =>  $this->Mitrakg_mod->getKategori(),
            'user' => $builder,
            'produk' => $produk,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/mitrakg/v_produk', $data);
    }

    public function tambahProduk()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $id_mitra = $builder['id_mitra_pes'];
        $merchant = $this->Mitrakg_mod->getMerchant($id_mitra)->get()->getresultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Tambah Produk',
            'kategori' =>  $this->Mitrakg_mod->getKategori(),
            'subkategori' =>  $this->Mitrakg_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $merchant,
            'satuan' =>  $this->Mitrakg_mod->get_satuan(),
            'user' => $builder,

            'validation' => \Config\Services::validation(),
        ];
        return view('backend/mitrakg/tambah_produk', $data);
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
            return redirect()->to('/backend/mitrakg/tambahProduk')->withInput();
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
        $id = $this->request->getPost('id_created');
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
        $id_mitra_produk = $this->request->getVar('id_mitra_produk');
        $id_merchant_prod = $this->request->getVar('id_merchant_prod');
        $fee_kg = $this->request->getVar('fee_kg');
        $fee_mitra = $this->request->getVar('fee_mitra');

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
            'fee_mitra' => $fee_mitra,
            'fee_kg' => $fee_kg,
            'id_merchant_prod' => $id_merchant_prod,
            'id_mitra_produk' => $id_mitra_produk,
            'id_created' => $id,
            'date_created'     => date("Y-m-d\TH:i:s"),
            'foto_1' => $gambar[0],
            'foto_2' => ($jumlah > 1) ? $gambar[1] : '',
            'foto_3' => ($jumlah > 2) ? $gambar[2] : '',
            'foto_4' => ($jumlah > 3) ? $gambar[3] : '',
        ];

        $this->Mitrakg_mod->tambahProd($data);
        return redirect()->to(base_url('/backend/mitrakg/produk'))->with('success', 'Data Produk berhasil ditambah');
    }

    function get_edit($product_id)
    {
        $builder = $this->user_aktif();
        $id_mitra = $builder['id_mitra_pes'];
        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'product_id' => $product_id,
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Mitrakg_mod->getKategori(),
            'subkategori' =>  $this->Mitrakg_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Mitrakg_mod->getMerchant($id_mitra)->get()->getResultArray(),
            'satuan' =>  $this->Mitrakg_mod->get_satuan(),
            'user' => $builder,
            'produk' => $this->Mitrakg_mod->getProdukById2($product_id)->get()->getRowArray(),
            'validation' => \Config\Services::validation(),
        ];

        $data['product_id'] = $product_id;
        $get_data = $this->Mitrakg_mod->getProdukById2($product_id);
        if ($get_data->CountAllResults() > 0) {
            $row = $get_data->get()->getRowArray();
            $data['sub_category_id'] = $row['id_sub_kat_prod'];
        }
        return view('backend/mitrakg/update_prod', $data);
    }

    function get_data_edit()
    {
        $product_id = $this->request->getVar('product_id');
        $data = $this->Mitrakg_mod->getProdukById2($product_id)->get()->getRowArray();
        echo json_encode($data);
    }

    function ambilSubKategori()
    {
        $category_id = $this->request->getPost('id');
        $data = $this->Mitrakg_mod->get_sub_category($category_id);
        echo json_encode($data);
    }

    public function updateProduk($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }
        $builder = $this->user_aktif();
        $produk = $this->Mitrakg_mod->get_edit_produk($id)->get()->getRowArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Mitrakg_mod->getKategori(),
            'subkategori' =>  $this->Mitrakg_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Mitrakg_mod->getMerchant(),
            'satuan' =>  $this->Mitrakg_mod->get_satuan(),
            'user' => $builder,
            'produk' => $produk,
            'id' => $id,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/mitrakg/update_prod', $data);
    }

    function update_pro_act()
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
            $product_id = $this->request->getVar('product_id');
            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/backend/mitrakg/get_edit/' . $product_id)->withInput();
        }
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $id = $this->request->getPost('id_created');
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
        $id_mitra_produk = $this->request->getVar('id_mitra_produk');
        $id_merchant_prod = $this->request->getVar('id_merchant_prod');
        $fee_kg = $this->request->getVar('fee_kg');
        $fee_mitra = $this->request->getVar('fee_mitra');
        $product_id = $this->request->getVar('product_id');

        // upload semua foto
        $files = $this->request->getFiles();
        $foto_produk = $this->request->getFile('foto_produk');

        if ($files['foto_produk']['0']->getError() != 4) {
            foreach ($files['foto_produk'] as $img) {
                // upload dengan random name
                $img->move('assets/images/produk/');
            }
            $produk_old = $this->Mitrakg_mod->getProdukById2($product_id)->get()->getRowArray();
            if ($produk_old['foto_1'] != null) {
                unlink('assets/images/produk/' . $produk_old['foto_1']);
            }
            if ($produk_old['foto_2'] != null) {
                unlink('assets/images/produk/' . $produk_old['foto_2']);
            }
            if ($produk_old['foto_3'] != null) {
                unlink('assets/images/produk/' . $produk_old['foto_3']);
            }
            if ($produk_old['foto_4'] != null) {
                unlink('assets/images/produk/' . $produk_old['foto_4']);
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
                'fee_mitra' => $fee_mitra,
                'fee_kg' => $fee_kg,
                'id_merchant_prod' => $id_merchant_prod,
                'id_mitra_produk' => $id_mitra_produk,
                'id_created' => $id,
                'date_created'     => date("Y-m-d\TH:i:s"),
                'foto_1' => $gambar[0],
                'foto_2' => ($jumlah > 1) ? $gambar[1] : '',
                'foto_3' => ($jumlah > 2) ? $gambar[2] : '',
                'foto_4' => ($jumlah > 3) ? $gambar[3] : '',
            ];
            $this->Mitrakg_mod->updateProdukact($data, $product_id);
            return redirect()->to(base_url('/backend/mitrakg/produk'))->with('success', 'Data Produk berhasil ditambah');
        } else {
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
                'fee_mitra' => $fee_mitra,
                'fee_kg' => $fee_kg,
                'id_merchant_prod' => $id_merchant_prod,
                'id_mitra_produk' => $id_mitra_produk,
                'id_created' => $id,
                'date_created'     => date("Y-m-d\TH:i:s"),
            ];
            $this->Mitrakg_mod->updateProdukact($data, $product_id);
            return redirect()->to(base_url('/backend/mitrakg/produk'))->with('success', 'Data Produk berhasil ditambah');
        }
    }

    public function detailProduk($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $produk = $this->Mitrakg_mod->getProdukById2($id)->get()->getRowArray();

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

        return view('backend/mitrakg/detail_prod', $data);
    }

    public function deleteprod()
    {
        $id = $this->request->getPost('id_produk2');
        $produk = $this->Mitrakg_mod->getProdukById2($id)->get()->getRowArray();

        if ($produk['foto_1'] != null) {
            unlink('assets/images/produk/' . $produk['foto_1']);
        }
        if ($produk['foto_2'] != null) {
            unlink('assets/images/produk/' . $produk['foto_2']);
        }
        if ($produk['foto_3'] != null) {
            unlink('assets/images/produk/' . $produk['foto_3']);
        }
        if ($produk['foto_4'] != null) {
            unlink('assets/images/produk/' . $produk['foto_4']);
        }
        $this->Mitrakg_mod->deleteprod($id);
        return redirect()->to(base_url('/backend/mitrakg/produk'))->with('success', 'Data produk berhasil di hapus !');
    }
}
