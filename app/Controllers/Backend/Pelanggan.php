<?php

namespace App\Controllers\Backend;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->Pel = new PelangganModel();
        $this->cek_login();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }
        $pelanggan = $this->db->table('tbl_pelanggan')->get()->getResultArray();

        $builder = $this->user_aktif();


        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Pelanggan',
            'menu' => 'Pelanggan',
            'user' => $builder,
            'pelanggan' => $pelanggan,
        ];

        return view('backend/pelanggan/index', $data);
    }
}
