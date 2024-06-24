<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    public function index()
    {
        $data['user'] = $this->M_user->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pages/index', $data);
        $this->load->view('templates/footer');
    }
    public function activity()
    {
        $this->load->model('M_activity');
        $data['activity'] = $this->M_activity->tampil_data();
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