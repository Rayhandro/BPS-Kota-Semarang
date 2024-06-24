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
} 