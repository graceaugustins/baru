<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'User Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('components/head_user', $data);
        $this->load->view('user/index', $data);
        $this->load->view('components/footer_user', $data);
    }


    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Seminar_model');
        $data['seminars'] = $this->Seminar_model->get_seminars_by_user_id($data['user']['id']);

        $this->load->model('Hardskill_Softskill_model');
        $data['hardskills'] = $this->Hardskill_Softskill_model->get_hardskill_softskill_by_user_id($data['user']['id']);


        $this->load->view('components/head_user', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('components/footer_user', $data);
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Seminar_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('components/head_user', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('components/footer_user', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo ($this->upload->display_errors());
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your profile has been updated!</div>');
            redirect('user');
        }
    }
}
