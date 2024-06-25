<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row();
    }



    // Add more functions as needed
}
