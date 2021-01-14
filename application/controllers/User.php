<?php

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->library('form_validation');
  }

  public function registerUser()
  {

    $this->form_validation->set_rules('username', 'Full Name', 'required');
    $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[13]|is_unique[users.mobile]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    $this->form_validation->set_rules('role', 'Role', 'required');

    if ($this->form_validation->run() == FALSE) {
    } else {
      $mobile = $this->input->post('mobile');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

      $response = $this->um->registerUser($mobile, $password);

      if ($response)
        exit(json_encode($response));
      return FALSE;
    }
  }
  public function login()
  {
    $this->form_validation->set_rules('mobile', "Mobile Number", 'required|min_length[10]|max_length[13]');
    $this->form_validation->set_rules('password', "Password", 'required|min_length[8]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_userdata('errors', validation_errors());
      redirect('login');
    } else {
      $mobile = $this->input->post('mobile');
      $password = $this->input->post('password');
      $response =  $this->um->loginUser($mobile, $password);

      if ($response['success']) {

        $user = $response['user'];

        $this->session->set_userdata($user);
        $this->session->unset_userdata('password');
        $this->session->set_userdata('is_logged_in', TRUE);

        if ($user['active']) {
          $this->session->set_userdata('login_success', TRUE);
          redirect('home');
        } else {
          redirect('f_login');
        }
      } else {
        $this->session->set_userdata('errors', $response['errors']);
        redirect('login');
      }
    }
  }
  public function firstLogin()
  {
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_userdata('errors', validation_errors());
      redirect('f_login');
    } else {
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      $mobile = $this->session->mobile;

      $response = $this->um->handleFirstLogin($mobile, $password);

      if ($response) {
        $this->session->set_userdata('active', '1');

        redirect('home');
      } else {
        $this->session->set_userdata('errors', "Couldn't Update Your Password, Try Again!!");
        redirect('f_login');
      }
    }
  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('home');
  }
}
