<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model

{
    // <--------------------------------MERCHANT----------------------------------->
    public function getUser()
    {
        $query = $this->db->table('tbl_peserta a');
        $query->select('a.*, b.nama_mitra');
        $query->join('tbl_mitra b', 'b.id_mitra = a.id_mitra_pes', 'left');

        return $query;
    }

    public function tambahPengguna($data)
    {
        $query = $this->db->table('tbl_peserta')->insert($data);
        return $query;
    }

    public function updatePengguna($data, $id)
    {
        $query = $this->db->table('tbl_peserta')->update($data, array('id_peserta' => $id));
        return $query;
    }

    public function resetPassword($data, $id)
    {
        $query = $this->db->table('tbl_peserta')->update($data, array('id_peserta' => $id));
        return $query;
    }

    public function deletePengguna($id)
    {
        $query = $this->db->table('tbl_peserta')->delete(array('id_peserta' => $id));
        return $query;
    }

    public function getMitra()
    {
        return $this->db->table('tbl_mitra')->get()->getResultArray();
    }
}
