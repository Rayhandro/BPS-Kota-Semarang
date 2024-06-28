<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('M_user');
        $this->load->model('M_activity');
        $this->load->model('M_kegiatan');
    }

    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // Ambil data dari session
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        // Load view user dashboard
        $data['title'] = 'User Dashboard';
        $this->load->view('pages/user/templates/header');
        $this->load->view('pages/user/index');
        $this->load->view('pages/user/templates/footer');
    }

    public function form()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // if ($tipe_form == 'pelaksanaan') {
        //     $kegiatan = 
        // } elseif ($tipe_form == 'kembali') {
        //     $kegiatan = $this->M_kegiatan->get_kegiatan_pelaksanaan($id_user);
        // }

        // Ambil data dari session
        $data['user_id'] = $this->session->userdata('user_id');
        $data['pelaksanaan'] = $this->M_kegiatan->get_kegiatan_keluar($this->session->userdata('user_id'));
        $data['kembali'] = $this->M_kegiatan->get_kegiatan_pelaksanaan($this->session->userdata('user_id'));
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        // Load form view
        $data['title'] = 'User Form';
        $this->load->view('pages/user/templates/header-back', $data);
        $this->load->view('pages/user/form', $data);
        $this->load->view('pages/user/templates/footer');
    }

    public function history()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // Ambil data dari session
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        // Load form view

        $data['history'] = $this->M_activity->get_history($data['user_id']);

        $data['title'] = 'User History';
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
