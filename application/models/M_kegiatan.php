<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Kegiatan extends CI_Model
{
    public function insert_kegiatan($data)
    {
        return $this->db->insert('tbl_kegiatan', $data);
    }
    public function get_activity_by_id($id)
    {
        return $this->db->get_where('tbl_kegiatan', array('id_kegiatan' => $id))->row_array();
    }

    public function update_activity($id, $data)
    {
        $this->db->where('id_kegiatan', $id);
        return $this->db->update('tbl_kegiatan', $data);
    }

    public function delete_activity($id)
    {
        $this->db->where('id_kegiatan', $id);
        return $this->db->delete('tbl_kegiatan');
    }
    public function get_kegiatan_by_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->get('tbl_kegiatan')->result_array();
    }

    // Fungsi untuk mendapatkan kegiatan keluar
    public function get_kegiatan_keluar($id_user)
    {
        // return $this->db->get_where('tbl_kegiatan', array('id_user' => $id_user, 'keluar'=> 1))->row_array();
        $this->db->where('id_user', $id_user);
        $this->db->where('keluar', 1);
        return $this->db->get('tbl_kegiatan')->result_array();
    }

    // Fungsi untuk mendapatkan kegiatan pelaksanaan
    public function get_kegiatan_pelaksanaan($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('pelaksanaan', 1);
        return $this->db->get('tbl_kegiatan')->result_array();
    }
}
