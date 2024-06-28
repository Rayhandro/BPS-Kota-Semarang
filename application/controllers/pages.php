<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('M_activity');
    }
    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        $data['user'] = $this->M_user->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pages/index', $data);
        $this->load->view('templates/footer');
    }
    public function activity()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('M_activity');
        $this->load->model('M_user');
        $data['activity'] = $this->M_activity->tampil_data(); // Adjust this method as per your model
        $data['user'] = $this->M_user->tampil_data(); // Adjust this method as per your model
        foreach ($data['activity'] as &$activity) {
            $activity['count'] = $this->M_activity->count_activity_by_user_and_kegiatan($activity['id_kegiatan'], $activity['id_user']);
        }

        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pages/activity', $data);
        $this->load->view('templates/footer');
    }
    public function login()
    {
        $this->load->view('pages/login');
    }
    public function register()
    {
        $this->load->view('pages/register');
    }
}