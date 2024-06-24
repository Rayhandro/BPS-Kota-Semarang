<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->M_user->login($email, $password);

            if ($user) {
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('/'); // Ubah ke halaman setelah login yang sesuai
            } else {
                $this->session->set_flashdata('message', 'Invalid username or password');
                redirect('pages/login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('authcontroller/login');
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');
        // $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pages/register');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'staff'
            );

            if ($this->M_user->register($data)) {
                $this->session->set_flashdata('message', 'Registration successful! Please login.');
                redirect('pages/login');
            } else {
                $this->session->set_flashdata('message', 'Registration failed! Please try again.');
                redirect('pages/register');
            }
        }
    }
}