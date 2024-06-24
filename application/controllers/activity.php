<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load model
        $this->load->model('M_activity');
        // Load form and url helper
        $this->load->helper(array('form', 'url'));
        // Load form validation library
        $this->load->library('form_validation');

        
    }
    public function index()
    {
        // Get all activities from the model
        $data['activity'] = $this->M_activity->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pages/activity', $data);
        $this->load->view('templates/footer');

    }
    public function addActivity()
    {
        // $this->form_validation->set_rules('id_user', 'ID User', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required');
        $this->form_validation->set_rules('jam_kembali', 'Jam Kembali', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        // $this->form_validation->set_rules('foto', 'foto', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Load the view with form errors
            $data['activity'] = $this->M_activity->tampil_data();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('pages/activity', $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', 'Gagal menambahkan data!');
            
            $this->session->set_flashdata('message_type', 'danger');
        } else {
            // Prepare data to be inserted
            $data = array(
                'id_user' => $this->session->userdata('user_id'),
                'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                'tanggal' => $this->input->post('tanggal'),
                'waktu' => $this->input->post('waktu'),
                'jam_kembali' => $this->input->post('jam_kembali'),
                'latlong' => $this->input->post('lokasi'),
                'foto' => $this->_upload_file() // Handle file upload
            );

            // Insert data using the model
            $this->M_activity->insert_activity($data);

           
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            $this->session->set_flashdata('message_type', 'success');
            

            // Redirect to the activity list page
            redirect('pages/activity');
        }
    }
    private function _upload_file() {
        // File upload configuration
        $upload_path = FCPATH.'/application/uploads/';

        // $upload_path = realpath(APPPATH . '../uploads');

        // Cek apakah folder uploads ada, jika tidak, buat folder tersebut
        // if (!is_dir($upload_path)) {
        //     mkdir($upload_path, 777, TRUE);
        // }
        // chmod($upload_path, 777);
        $username = $this->session->userdata('username');
    
    // Buat format nama file: kegiatan_username_datetime
        // $file_name = 'kegiatan'. $username .date('Ymd_His');
        $config['upload_path']          = FCPATH.'/application/uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        // $config['file_name']            = $file_name;
        $config['file_ext_tolower']     = true;
        $config['overwrite']            = true; // tindih file dengan file baru
        $config['max_size']             = 1024; // batas ukuran file: 1MB
        $config['max_width']            = 1080; // batas lebar gambar dalam piksel
        $config['max_height']           = 1080; // 2MB

        $this->load->library('upload',$config);
        // $this->upload->initialize($config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            // If file upload fails, return an empty string
            return '';
        } else {
            // If file upload succeeds, return the file name
            $this->upload->data();

            return $this->upload->data('file_name');
        }
    }
    public function editActivity($id) {
        $data['activity'] = $this->M_activity->get_activity_by_id($id);
    
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('jam_kembali', 'Jam Kembali', 'required');
        $this->form_validation->set_rules('latlong', 'Lokasi', 'required');  // Ensure 'latlong' is used if that's the input name
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('message_type', 'danger');
            redirect('pages/activity');
        } else {
            $update_data = array();
    
            if ($this->input->post('nama_kegiatan')) {
                $update_data['nama_kegiatan'] = $this->input->post('nama_kegiatan');
            }
            if ($this->input->post('jam_kembali')) {
                $update_data['jam_kembali'] = $this->input->post('jam_kembali');
            }
            if ($this->input->post('latlong')) {  // Ensure 'latlong' is used if that's the input name
                $update_data['latlong'] = $this->input->post('latlong');
            }
            if (!empty($_FILES['file']['name'])) {
                $update_data['foto'] = $this->_upload_file();
            }
    
            if ($this->M_activity->update_activity($id, $update_data)) {
                $this->session->set_flashdata('message', 'Data berhasil diupdate!');
                $this->session->set_flashdata('message_type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Gagal mengupdate data!');
                $this->session->set_flashdata('message_type', 'danger');
            }
    
            redirect('pages/activity');
        }
    }
        
    
    public function deleteActivity($id) {
        if ($this->M_activity->delete_activity($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Gagal menghapus data!');
            $this->session->set_flashdata('message_type', 'danger');
        }
        redirect('pages/activity');
    }   
}