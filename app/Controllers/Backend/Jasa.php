<?php

namespace App\Controllers\Backend;

use App\Models\JasaModel;

class Jasa extends BaseController
{

    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->Jasa_mod = new JasaModel();
        $this->cek_login();
    }

    // <--------------------------------PRODUK----------------------------------->

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();

        $jasa = $this->Jasa_mod->get_jasa()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Jasa',
            'menu' => 'Master',
            'submenu' => 'Jasa',
            'user' => $builder,
            'jasa' => $jasa,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/jasa/index', $data);
    }

    public function tambahjasa()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $jasa = $this->Jasa_mod->get_jasa()->get()->getResultArray();


        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Jasa',
            'menu' => 'Master',
            'submenu' => 'Tambah Jasa',
            'kategori' =>  $this->Jasa_mod->getKategori(),
            'subkategori' =>  $this->Jasa_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Jasa_mod->getMerchant(),
            'satuan' =>  $this->Jasa_mod->get_satuan(),
            'user' => $builder,
            'jasa' => $jasa,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/jasa/tambah_jasa', $data);
    }

    function ambilSubKategori()
    {

        $category_id = $this->request->getPost('id');
        $data = $this->Jasa_mod->get_sub_category($category_id);
        echo json_encode($data);
    }

    function inputjasa()
    {
        if (!$this->validate([
            'foto_jasa' => [
                'rules' => 'mime_in[foto_jasa,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_jasa,1024]|is_image[foto_jasa]',
                'errors' => [
                    'is_image' => 'yang anda pilih bukan gambar.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'mime_in' => 'Ekstensi file harus .jpg, .jpeg, .png.'
                ]
            ],
            'nama_jasa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Jasa harus di isi.',
                ]
            ],
            'sopir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Sopir harus di isi.',
                ]
            ],
            'transmisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Transmisi harus di isi.',
                ]
            ],
            'harga_modal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Harga Modal Jasa harus di isi.',
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Harga Jual Jasa harus di isi.',
                ]
            ],
            'syarat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Syarat & Ketentuan Jasa harus di isi.'
                ]
            ],
            'id_kat_jasa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kategori harus di isi.'
                ]
            ],
            'id_sub_kat_jasa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Sub Kategori harus di isi.'
                ]
            ],
            'id_penyedia' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Merchant harus di isi.'
                ]
            ],
        ])) {

            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/backend/jasa/tambahjasa')->withInput();
        }

        // upload semua foto
        $files = $this->request->getFile('foto_jasa');

        $slug_jasa = url_title($this->request->getVar('nama_jasa'), '-', true);
        $files->move('assets/images/jasa/', $slug_jasa);

        $id = $this->request->getPost('id_buat');
        $nama_jasa = $this->request->getVar('nama_jasa');
        $syarat = $this->request->getVar('syarat');
        $harga_modal = $this->request->getVar('harga_modal');
        $harga_jual = $this->request->getVar('harga_jual');
        $id_kat_jasa = $this->request->getVar('id_kat_jasa');
        $id_sub_kat_jasa = $this->request->getVar('id_sub_kat_jasa');
        $sopir = $this->request->getVar('sopir');
        $transmisi = $this->request->getVar('transmisi');
        $id_penyedia = $this->request->getVar('id_penyedia');

        $data = [
            'nama_jasa' => $nama_jasa,
            'slug_jasa' => $slug_jasa,
            'foto_jasa' => $slug_jasa,
            'harga_jual' => $harga_jual,
            'id_sub_kat_jasa' => $id_sub_kat_jasa,
            'harga_modal' => $harga_modal,
            'transmisi' => $transmisi,
            'sopir' => $sopir,
            'syarat' => $syarat,
            'id_kat_jasa' => $id_kat_jasa,
            'id_penyedia' => $id_penyedia,
            'id_created' => $id,
            'date_created'     => date("Y-m-d\TH:i:s"),
        ];

        $this->Jasa_mod->inputjasa($data);
        return redirect()->to(base_url('/backend/jasa'))->with('success', 'Data Jasa berhasil ditambah');
    }

    function get_edit($product_id)
    {
        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'product_id' => $product_id,
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Jasa_mod->getKategori(),
            'subkategori' =>  $this->Jasa_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Jasa_mod->getMerchant(),
            'satuan' =>  $this->Jasa_mod->get_satuan(),
            'user' => $this->user_aktif(),
            'produk' => $this->Jasa_mod->get_edit_produk($product_id)->get()->getRowArray(),
            'validation' => \Config\Services::validation(),
        ];
        $data['product_id'] = $product_id;
        $get_data = $this->Jasa_mod->getProdukById($product_id);
        if ($get_data->CountAllResults() > 0) {
            $row = $get_data->get()->getRowArray();
            $data['sub_category_id'] = $row['id_sub_kat_prod'];
        }
        return view('backend/master/update_prod', $data);
    }

    function get_data_edit()
    {
        $product_id = $this->request->getVar('product_id');
        $data = $this->Jasa_mod->getProdukById($product_id)->get()->getRowArray();
        echo json_encode($data);
    }

    public function updateProduk($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $produk = $this->Jasa_mod->get_edit_produk($id)->get()->getRowArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Produk',
            'menu' => 'Master',
            'submenu' => 'Update Produk',
            'kategori' =>  $this->Jasa_mod->getKategori(),
            'subkategori' =>  $this->Jasa_mod->getSubKategori()->get()->getResultArray(),
            'merchant' =>  $this->Jasa_mod->getMerchant(),
            'satuan' =>  $this->Jasa_mod->get_satuan(),
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
        $produk = $this->Jasa_mod->getProdukById($id)->get()->getRowArray();

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

    function updateKar()
    {
        if (!$this->validate([

            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom [{field}] / harus di isi.',
                    'valid_email' => 'Email tidak valid '
                ]
            ],
            'nama_pes' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom [{field}] / harus di isi.'
                ]
            ],
            'hp_pes' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom [{field}] / harus di isi.'
                ]
            ],
        ])) {

            // return redirect()->to('/profil')->withInput()->with('validation', $validation);
            return redirect()->to('/backend/master/karyawan')->withInput();
        }

        $id = $this->request->getPost('id_buat');
        $id_peserta = $this->request->getPost('id_peserta');
        $tgl_masuk = $this->request->getPost('tgl_masuk');

        $data = [
            'no_bpjstku'              => intval($this->request->getPost('no_bpjstku')),
            'no_ktp'              => intval($this->request->getPost('no_ktp')),
            'no_rek'              => intval($this->request->getPost('no_rek')),
            'role_id'              => intval($this->request->getPost('akses')),
            'date_updated'              => date("Y-m-d\TH:i:s"),
            'nama_peserta'              => $this->request->getPost('nama_pes'),
            'email_peserta'             => $this->request->getPost('email'),
            'alamat_peserta'              => $this->request->getPost('alamat_pes'),
            'no_hp_peserta'          => $this->request->getPost('hp_pes'),
            'id_jabatan_k'          => intval($this->request->getPost('jabatan')),
            'id_dept_k'          => intval($this->request->getPost('dept')),
            'id_buat'          => intval($id),
            'nip'          => intval($this->request->getPost('no_ktp')),
            'no_kontrak'          => $this->request->getPost('no_kontrak'),
            'tgl_masuk'          => date('Y-m-d', strtotime(str_replace('/', '-', $tgl_masuk))),
        ];

        $this->Jasa_mod->updateKar($data, $id_peserta);
        return redirect()->to(base_url('/backend/master/karyawan'))->with('success', 'Data Member berhasil di update');
    }

    public function deleteKar()
    {
        $id = $this->request->getPost('id_jabatan2');

        $this->Jasa_mod->deleteKar($id);
        return redirect()->to(base_url('/backend/master/karyawan'))->with('success', 'Data karyawan berhasil di hapus !');
    }

    public function detail_karyawan($id)
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();
        $karyawan = $this->Jasa_mod->get_edit_karyawan($id)->get()->getRowArray();

        $data = [
            'judul' => 'Detail Member GKD',
            'menu' => 'Master',
            'submenu' => 'Detail Member GKD',
            'user' => $builder,
            'karyawan' => $karyawan,
            'id' => $id,
        ];
        return view('backend/master/detail_kar', $data);
    }
}
