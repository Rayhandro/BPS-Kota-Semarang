<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Activity extends CI_Model
{
    public function tampil_data()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('activity')->result_array();
    }
    public function insert_activity($data) {
        return $this->db->insert('activity', $data);
    }
    public function get_activity_by_id($id) {
        return $this->db->get_where('activity', array('id' => $id))->row_array();
    }

    public function update_activity($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('activity', $data);
    }

    public function delete_activity($id) {
        $this->db->where('id', $id);
        return $this->db->delete('activity');
    }
} 