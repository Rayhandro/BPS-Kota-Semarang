<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function tampil_data()
    {
        return $this->db->get('user')->result_array();
    }
    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
    public function register($data) {
        return $this->db->insert('user', $data);
    }
} 