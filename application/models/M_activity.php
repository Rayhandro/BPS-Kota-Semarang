<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Activity extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('activity.*, user.username, user.nama_pegawai ,tbl_kegiatan.nama_kegiatan , ');
        $this->db->from('activity');
        $this->db->join('user', 'user.id = activity.id_user');
        $this->db->join('tbl_kegiatan', 'tbl_kegiatan.id_kegiatan = activity.id_kegiatan');
        // $this->db->group_by('activity.id_kegiatan');
        $this->db->order_by('id_kegiatan', 'ASC');
        $this->db->order_by('jam_keluar', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count_activity_by_user_and_kegiatan($id_kegiatan, $id_user)
    {
        $this->db->where('id_kegiatan', $id_kegiatan);
        $this->db->where('id_user', $id_user);
        $this->db->from('activity'); // Ganti 'activity' dengan nama tabel Anda jika berbeda

        return $this->db->count_all_results();
    }
    public function insert_activity($data)
    {
        return $this->db->insert('activity', $data);
    }
    public function get_activity_by_id($id)
    {
        return $this->db->get_where('activity', array('id' => $id))->row_array();
    }

    public function update_activity($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('activity', $data);
    }

    public function delete_activity($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('activity');
    }
    public function get_history($user_id)
    {
        $this->db->select('activity.*, user.username, user.nama_pegawai');
        $this->db->from('activity');
        $this->db->join('user', 'user.id = activity.id_user');
        $this->db->where('activity.id_user', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
