<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('seminar_model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function upload_and_process_ocr_seminar()
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/file-sertifikat/';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode(array('status' => 'error', 'message' => $error['error']));
                return;
            } else {
                $uploaded_data = $this->upload->data();
                $uploaded_file_path = $upload_path . $uploaded_data['file_name'];

                // Contoh menggunakan Tesseract OCR (sesuaikan dengan instalasi dan path Tesseract Anda)
                $tesseract_path = 'C:\Program Files\Tesseract-OCR\tesseract.exe'; // Sesuaikan dengan lokasi instalasi Tesseract Anda
                $image_path = $uploaded_file_path;

                // Proses OCR menggunakan Tesseract
                exec("$tesseract_path $image_path stdout", $output);

                // Ambil hasil OCR (misalnya kegiatan, tanggal, kategori)
                $ocr_results = implode(' ', $output); // hasil OCR disimpan dalam $ocr_results

                // Parsing hasil OCR untuk diisi ke form (contoh sederhana, sesuaikan parsing ini)
                $data = array(
                    'kegiatan' => 'Hasil Kegiatan OCR', // Ambil dari $ocr_results
                    'tanggal' => '2023-06-28', // Ambil dari $ocr_results
                    'kategori' => 'Nasional', // Ambil dari $ocr_results
                    'file' => $uploaded_data['file_name']
                );

                echo json_encode(array('status' => 'success', 'data' => $data));
                return;
            }
        }
    }

    public function confirm_ocr_seminar()
    {
        $data = $this->session->userdata('ocr_results');

        // Load view form confirmation with OCR results data
        $this->load->view('user/dashboard', $data);
    }


    public function save_data_ocr()
    {
        $data = array(
            'kegiatan' => $this->input->post('kegiatan'),
            'tanggal' => $this->input->post('tanggal'),
            'kategori' => $this->input->post('kategori'),
            'file' => $this->session->userdata('uploaded_file'), // Menggunakan file yang sudah diupload
        );

        $insert_id = $this->seminar_model->insert_seminar($data); // Panggil model untuk menyimpan data

        if ($insert_id) {
            $this->session->set_flashdata('success', 'Data seminar berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data seminar.');
        }

        // Hapus data session setelah disimpan
        $this->session->unset_userdata('ocr_results');
        $this->session->unset_userdata('uploaded_file');

        redirect('user/dashboard'); // Redirect ke halaman sukses
    }


    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'User Login';
            $this->load->view('components/head', $data);
            $this->load->view('auth/login');
            $this->load->view('components/footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }

    public function success()
    {
        $this->load->view('success');
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //usernya ada

        if ($user) {
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'user_id' => $user['id'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth');
            }
        }
    }

    public function save_data()
    {
        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Save Data';
            $this->load->view('components/head', $data);
            $this->load->view('user/index');  // Ensure this view exists and is correct
            $this->load->view('components/footer');
        } else {
            $user_id = $this->session->userdata('user_id');
            $data = [
                'kegiatan' => htmlspecialchars($this->input->post('kegiatan', true)),
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'kategori' => htmlspecialchars($this->input->post('kategori', true)),
                'user_id' => $user_id,
            ];

            // Handle file upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/file-sertifikat/';

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $data['file'] = $new_image; // Add the filename to the data array
                } else {
                    // Debugging: Log the upload error
                    log_message('error', 'File upload failed: ' . $this->upload->display_errors());
                    echo 'File upload failed: ' . $this->upload->display_errors();
                    return; // Stop execution if upload fails
                }
            }
            $this->load->library('upload', $config);
            // Debugging
            log_message('debug', 'Data to be inserted: ' . print_r($data, true));

            // Insert data into the seminar table
            $this->load->model('seminar_model');
            if ($this->seminar_model->insert_seminar($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your data have been saved!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data insertion failed!</div>');
            }
            redirect('user/dashboard');
        }
    }


    public function save_data_kompetensi()
    {
        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required|trim');
        $this->form_validation->set_rules('program', 'program', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Save Data';
            $this->load->view('components/head', $data);
            $this->load->view('user/index');  // Ensure this view exists and has no errors
            $this->load->view('components/footer');
        } else {
            $user_id = $this->session->userdata('user_id');

            // Debugging: check if user_id is retrieved correctly from the session
            log_message('debug', 'User ID from session: ' . print_r($user_id, true));

            $data = [
                'kegiatan' => htmlspecialchars($this->input->post('kegiatan', true)),
                'program' => htmlspecialchars($this->input->post('program', true)),
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
            ];

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/file-sertifikat/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $data['file'] = $new_image;
                } else {
                    echo ($this->upload->display_errors());
                }
            }

            // Debugging
            log_message('debug', 'Data to be inserted: ' . print_r($data, true));

            $this->db->insert('hardskill_softskill', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your data have been saved!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data insertion failed!</div>');
            }
            redirect('user/dashboard');
        }
    }

    public function delete_seminar($id)
    {
        $this->load->model('Seminar_model');
        $this->Seminar_model->delete_seminar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data seminar berhasil dihapus!</div>');
        redirect('user/dashboard');
    }

    public function delete_hardskill($id)
    {
        $this->load->model('HardskillSoftskill_model');
        $this->HardskillSoftskill_model->delete_hardskill($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data hardskill & softskill berhasil dihapus!</div>');
        redirect('user/dashboard');
    }
    // Controller untuk menampilkan data seminar berdasarkan user_id
    public function show_seminar($user_id)
    {
        // Panggil model untuk mengambil data seminar
        $this->load->model('Seminar_model'); // Ganti 'Seminar_model' dengan nama model Anda
        $data['seminar'] = $this->Seminar_model->get_seminar_by_user_id($user_id);

        // Load view dan kirim data seminar ke view
        $this->load->view('seminar_view', $data);
    }
    public function update_seminar($seminar_id)
    {
        $data['title'] = 'Edit data seminar';
        $data['seminar'] = $this->db->get_where('seminar', ['id' => $seminar_id])->row_array();

        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('components/head_user', $data);
            $this->load->view('user/index', $data);
            $this->load->view('components/footer_user', $data);
        } else {
            $kegiatan = $this->input->post('kegiatan');
            $tanggal = $this->input->post('tanggal');
            $kategori = $this->input->post('kategori');

            // Initialize data array
            $update_data = [
                'kegiatan' => $kegiatan,
                'tanggal' => $tanggal,
                'kategori' => $kategori
            ];

            // Check if there's an image to upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/file-sertifikat/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $update_data['file'] = $new_image;
                } else {
                    echo ($this->upload->display_errors());
                }
            }

            // Update database using the model
            $this->load->model('Seminar_model');
            $this->Seminar_model->update_seminar($seminar_id, $update_data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data seminar berhasil di update!</div>');
            redirect('user/dashboard');
        }
    }

    // Controller untuk menampilkan data hardskill_softskill berdasarkan user_id
    public function show_hardskill_softskill($user_id)
    {
        // Panggil model untuk mengambil data hardskill_softskill
        $this->load->model('Hardskill_Softskill_model'); // Ganti 'hardskill_softskill' dengan nama model Anda
        $data['hardskill_softskill'] = $this->hardskill_softskill_model->get_hardskill_softskill_by_user_id($user_id);

        // Load view dan kirim data hardskill_softskill ke view
        $this->load->view('user/dashboard', $data);
    }

    public function update_hardskill_softskill($hardskill_id)
    {
        $data['title'] = 'Edit data Hardskill & Softskill';
        $data['hardskill_softskill'] = $this->db->get_where('hardskill_softskill', ['id' => $hardskill_id])->row_array();

        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('components/head_user', $data);
            $this->load->view('user/index', $data);
            $this->load->view('components/footer_user', $data);
        } else {
            $kegiatan = $this->input->post('kegiatan');
            $program = $this->input->post('program');
            $tanggal = $this->input->post('tanggal');

            // Initialize data array
            $update_data = [
                'kegiatan' => $kegiatan,
                'program' => $program,
                'tanggal' => $tanggal
            ];

            // Check if there's an image to upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/file-sertifikat/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $update_data['file'] = $new_image;
                } else {
                    echo ($this->upload->display_errors());
                }
            }

            // Update database using the model
            $this->load->model('Hardskill_Softskill_model');
            $this->Hardskill_Softskill_model->update_hardskill_softskill($hardskill_id, $update_data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data hardskill & softskill berhasil di update!</div>');
            redirect('user/dashboard');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'This email has already registered!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('components/head', $data);
            $this->load->view('auth/registration');
            $this->load->view('components/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created, Please Login!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}
