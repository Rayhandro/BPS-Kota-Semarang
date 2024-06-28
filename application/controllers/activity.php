<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('M_activity');
        $this->load->model('M_kegiatan');
        // Load form and url helper
        $this->load->helper(array('form', 'url'));
        // Load form validation library
        $this->load->library('form_validation');
    }
    public function index()
    {
        // Get all activities from the model
        if ($this->session->userdata('role') == 'admin') {
            redirect('pages/activity'); // Ganti dengan URL halaman admin
        } elseif (
            $this->session->userdata('role') == 'staff'
        ) {
            redirect('user/form'); // Ganti dengan URL halaman user
        } else {
            redirect('/login'); // Ganti dengan URL default setelah login
        }

        $data['activity'] = $this->M_activity->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pages/activity', $data);
        $this->load->view('templates/footer');
    }
    public function addActivity()
    {
        $this->form_validation->set_rules('id_user', 'ID User', 'required');
        $this->form_validation->set_rules('tipe_form', 'Tipe Form', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Data gagal ditambahkan!');
            $this->session->set_flashdata('message_type', 'danger');

            if ($this->session->userdata('role') == 'admin') {
                redirect('pages/activity'); // Ganti dengan URL halaman admin
            } elseif ($this->session->userdata('role') == 'staff') {
                redirect('user/form'); // Ganti dengan URL halaman user
            } else {
                redirect('/login'); 
            }
        } else {
            $keluar = 0;
            $pelaksanaan = 0;
            $kembali = 0;

            if($this->input->post('tipe_form') == 'keluar'){
                $keluar = 1;

                $data_kgt = array(
                    'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                    'id_user' => $this->session->userdata('user_id'),
                    'keluar' => $keluar,
                    'pelaksanaan' => $pelaksanaan,
                    'kembali' => $kembali,
                );

                $this->M_kegiatan->insert_kegiatan($data_kgt);

                $id_kegiatan = $this->db->insert_id();
            }else if($this->input->post('tipe_form') == 'pelaksanaan'){

                $data = array(
                    'keluar' => 0,
                    'pelaksanaan' => 1,
                    'kembali' => 0,
                );

                $this->M_kegiatan->update_activity($this->input->post('nama_kegiatan'),$data);
                $id_kegiatan = $this->input->post('nama_kegiatan');
            } else if ($this->input->post('tipe_form') == 'kembali') {
                $data = array(
                    'keluar' => 0,
                    'pelaksanaan' => 0,
                    'kembali' => 1,
                );
                
                $this->M_kegiatan->update_activity($this->input->post('nama_kegiatan'), $data);
                $id_kegiatan = $this->input->post('nama_kegiatan');
            }
            // Prepare data to be inserted
            $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_kegiatan' => $id_kegiatan,
                'tipe_form' => $this->input->post('tipe_form'),
                'tanggal' => $this->input->post('tanggal'),
                'jam' => $this->input->post('jam'),
                'latlong' => $this->input->post('lokasi'),
                'foto' => $this->_upload_file() // Handle file upload
            );

            $this->M_activity->insert_activity($data);


            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            $this->session->set_flashdata('message_type', 'success');


            if ($this->session->userdata('role') == 'admin') {
                redirect('pages/activity'); // Ganti dengan URL halaman admin
            } elseif ($this->session->userdata('role') == 'staff') {
                redirect('user/form'); // Ganti dengan URL halaman user
            } else {
                redirect('/login'); // Ganti dengan URL default setelah login
            }
        }
    }
    private function _upload_file()
    {
        // File upload configuration
        $upload_path = FCPATH . '/uploads/';

        $username = $this->session->userdata('username');

        // Buat format nama file: kegiatan_username_datetime
        $file_name = 'kegiatan_' . $username . date('Ymd_His');
        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $file_name;
        $config['file_ext_tolower']     = true;
        $config['overwrite']            = true; // tindih file dengan file baru
        $config['max_size']             = 1024; // batas ukuran file: 1MB
        $config['max_width']            = 1080; // batas lebar gambar dalam piksel
        $config['max_height']           = 1080; // 2MB

        $this->load->library('upload', $config);
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

    public function editActivity($id)
    {
        $id_kegiatan = $this->input->post('id_kegiatan');
        $data['activity'] = $this->M_activity->get_activity_by_id($id);

        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');
        // $this->form_validation->set_rules('latlong', 'Lokasi', 'required');  // Ensure 'latlong' is used if that's the input name

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('message_type', 'danger');
            redirect('pages/activity');
        } else {
            $update_data = array();
            $update_data_kegiatan = array();

            if ($this->input->post('nama_kegiatan')) {
                $update_data_kegiatan['nama_kegiatan'] = $this->input->post('nama_kegiatan');
            }
            if ($this->input->post('jam_kembali')) {
                $update_data['jam'] = $this->input->post('jam');
            }
            // if ($this->input->post('latlong')) {  // Ensure 'latlong' is used if that's the input name
            //     $update_data['latlong'] = $this->input->post('latlong');
            // }
            // if (!empty($_FILES['file']['name'])) {
            //     $update_data['foto'] = $this->_upload_file();
            // }

            if ($this->M_activity->update_activity($id, $update_data) && $this->M_kegiatan->update_activity($id_kegiatan, $update_data)) {
                $this->session->set_flashdata('message', 'Data berhasil diupdate!');
                $this->session->set_flashdata('message_type', 'success');
            } else {
                $this->session->set_flashdata('message', 'Gagal mengupdate data!');
                $this->session->set_flashdata('message_type', 'danger');
            }

            redirect('pages/activity');
        }
    }


    public function deleteActivity($id)
    {
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
