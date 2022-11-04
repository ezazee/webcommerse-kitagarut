<?php

namespace App\Controllers\Backend;

use App\Models\UserModel;

class User extends BaseController
{

    protected $helper = [];
    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->User_mod = new UserModel();
        $this->cek_login();
    }

    // <--------------------------------AKUN----------------------------------->

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();

        $userAkun = $this->User_mod->getUser()->get()->getResultArray();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Pengguna',
            'menu' => 'Pengaturan',
            'submenu' => 'Pengguna',
            'user' => $builder,
            'mitra' => $this->User_mod->getMitra(),
            'userAkun' => $userAkun,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/user/index', $data);
    }

    function tambahPengguna()
    {
        $nama_peserta = $this->request->getPost('nama_peserta');
        $id_mitra_pes = $this->request->getPost('id_mitra_pes');
        $alamat_peserta = $this->request->getPost('alamat_peserta');
        $no_hp_peserta = $this->request->getPost('no_hp_peserta');
        $email_peserta = $this->request->getPost('email_peserta');
        $role_id = $this->request->getPost('role_id');
        $password_hash = password_hash('qwerty123', PASSWORD_DEFAULT);

        $data = [
            'nama_peserta'     => $nama_peserta,
            'id_mitra_pes'     => $id_mitra_pes,
            'is_active'              => 1,
            'foto_peserta'         => 'default.jpg',
            'role_id'     => $role_id,
            'password'     => $password_hash,
            'email_peserta'     => $email_peserta,
            'alamat_peserta'     => $alamat_peserta,
            'no_hp_peserta'     => $no_hp_peserta,
            'id_buat'     => $this->request->getPost('id_login'),
            'date_created'     => date("Y-m-d\TH:i:s"),
        ];

        $this->User_mod->tambahPengguna($data);
        return redirect()->to(base_url('/backend/user'))->with('success', 'Data Pengguna berhasil di tambah !');
    }

    public function updatePengguna()
    {
        $id = $this->request->getPost('id_peserta2');
        $nama_peserta = $this->request->getPost('nama_peserta2');
        $id_mitra_pes = $this->request->getPost('id_mitra_pes2');
        $alamat_peserta = $this->request->getPost('alamat_peserta2');
        $no_hp_peserta = $this->request->getPost('no_hp_peserta2');
        $email_peserta = $this->request->getPost('email_peserta2');
        $role_id = $this->request->getPost('role_id2');

        $data = [
            'nama_peserta'     => $nama_peserta,
            'id_mitra_pes'     => $id_mitra_pes,
            'role_id'     => $role_id,
            'email_peserta'     => $email_peserta,
            'alamat_peserta'     => $alamat_peserta,
            'no_hp_peserta'     => $no_hp_peserta,

        ];

        $this->User_mod->updatePengguna($data, $id);
        return redirect()->to(base_url('/backend/user'))->with('success', 'Data Pengguna berhasil di update !');
    }
    public function resetPassword()
    {
        $id = $this->request->getPost('id_reset');
        $password_hash = password_hash('qwerty123', PASSWORD_DEFAULT);

        $data = [
            'password'     => $password_hash,
        ];

        $this->User_mod->resetPassword($data, $id);
        return redirect()->to(base_url('/backend/user'))->with('success', 'Password berhasil di reset !');
    }

    public function deletePengguna()
    {
        $id = $this->request->getPost('id_peserta3');

        $this->User_mod->deletePengguna($id);
        return redirect()->to(base_url('/backend/user'))->with('success', 'Data Pengguna berhasil di hapus !');
    }

    public function mitra()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('success', 'Silahkan Login dulu!');
            return redirect()->to(base_url('/admin'));
        }

        $builder = $this->user_aktif();

        $userAkun = $this->User_mod->getUser();

        $data = [
            'App' => 'KitaGarut',
            'judul' => 'Pengguna',
            'menu' => 'Pengaturan',
            'submenu' => 'Pengguna',
            'user' => $builder,
            'userAkun' => $userAkun,
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/user/index', $data);
    }
}
