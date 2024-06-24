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
    public function getUserById($id) {
        return $this->db->get_where('user', array('id' => $id))->row_array();
    }
    
    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }
    
    public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
} 