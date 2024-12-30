<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
  {
    $this->load->model('User_m');

    # Validasi form
    $this->form_validation->set_rules('username', 'Nama', 'required');
    $this->form_validation->set_rules('user_id', 'NIK', 'required|is_unique[user.user_id]');  
    $this->form_validation->set_rules('password', 'Password', 'required');


    # Pesan error
    $this->form_validation->set_message('required', '%s wajib diisi');
    $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar');

    if ($this->form_validation->run() == TRUE) {
      $v = [
        'user_id' => $this->input->post('user_id'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
      ];

      if ($this->User_m->register($v)) {
        $this->session->set_flashdata('pesan_sukses', 'Berhasil mendaftar!');
      }
      redirect('Login', 'refresh');
    }

    $post['errors'] = validation_errors();
    $this->load->view('register', $post);
  }
}