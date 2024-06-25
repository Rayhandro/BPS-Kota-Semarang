<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('User_model');
    }

    public function index()
    {
        // Load view user dashboard
        $data['title'] = 'User Dashboard';
        $this->load->view('pages/user/templates/header');
        $this->load->view('pages/user/index');
        $this->load->view('pages/user/templates/footer');
    }

    public function form()
    {
        // Load form view
        $data['title'] = 'User Form';
        $this->load->view('pages/user/templates/header-back', $data);
        $this->load->view('pages/user/form');
        $this->load->view('pages/user/templates/footer');
    }

    public function history()
    {
        // Load form view
        $data['title'] = 'User Form';
        $this->load->view('pages/user/templates/header-back', $data);
        $this->load->view('pages/user/history');
        $this->load->view('pages/user/templates/footer');
    }

    // public function profile()
    // {
    //     // Load user profile
    //     $data['title'] = 'User Profile';
    //     $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
    //     $this->load->view('user/template/header', $data);
    //     $this->load->view('user/profile', $data);
    //     $this->load->view('user/template/footer');
    // }

    // Add more functions as needed
}
