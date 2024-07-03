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
        $this->load->model('M_kegiatan');
        $data['activity'] = $this->M_activity->tampil_data(); // Adjust this method as per your model
        $data['user'] = $this->M_user->tampil_data(); // Adjust this method as per your model
        // foreach ($data['activity'] as &$activity) {
        //     $activity['count'] = $this->M_activity->count_activity_by_user_and_kegiatan($activity['id_kegiatan'], $activity['id_user']);
        // }
        $processed_data = [];
        $seen_combinations = [];

        // Proses dan kelompokkan data aktivitas
        foreach ($data['activity'] as $activity) {
            $key = $activity['id_kegiatan'] . '-' . $activity['id_user'];

            if (!in_array($key, $seen_combinations)) {
                $seen_combinations[] = $key;
                $grouped_data = $this->M_activity->get_activities_by_user_and_kegiatan($activity['id_kegiatan'], $activity['id_user']);

                $temp = [
                    'id_keluar' =>null ,
                    'id_pelaksanaan' =>null ,
                    'id_kembali' =>null,
                    'id_kegiatan' => $activity['id_kegiatan'],
                    'id_user' => $activity['id_user'],
                    'tanggal' => $activity['tanggal'],
                    'nama_kegiatan' => $this->M_kegiatan->get_activity_by_id($activity['id_kegiatan']),
                    'username' => $this->M_user->getUserById($activity['id_user']),
                    'tipe_form' => null,
                    'jam_keluar' => null,
                    'jam_pelaksanaan' => null,
                    'jam_kembali' => null,
                    'latlong' => null,
                    'foto' => null,
                ];

                foreach ($grouped_data as $group_activity) {
                    if ($group_activity['tipe_form'] == 'keluar') {
                        $temp['id_keluar'] = $group_activity['id'];
                        $temp['tipe_form'] = 'keluar';
                        $temp['jam_keluar'] = $group_activity['jam'];
                    } elseif ($group_activity['tipe_form'] == 'pelaksanaan') {
                        $temp['id_pelaksanaan'] = $group_activity['id'];
                        $temp['tipe_form'] = 'keluar-pelaksanaan';
                        $temp['tanggal'] = $group_activity['tanggal'];
                        $temp['jam_pelaksanaan'] = $group_activity['jam'];
                        $temp['latlong'] = $group_activity['latlong'];
                        $temp['foto'] = $group_activity['foto'];
                    } elseif ($group_activity['tipe_form'] == 'kembali') {
                        $temp['id_kembali'] = $group_activity['id'];
                        $temp['tipe_form'] = 'keluar-pelaksanaan-kembali';
                        $temp['jam_kembali'] = $group_activity['jam'];
                    }
                }

                $processed_data[] = $temp;
            }
        }


        $data['activities'] = $processed_data;
        // print_r($processed_data);
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