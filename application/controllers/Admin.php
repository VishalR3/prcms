<?php

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Kolkata');
  }
  public function view($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
      show_404();
    }

    if ($this->session->is_logged_in) {
      $data['users'] = $this->um->getUsers();
      $data['roles'] = $this->um->getRoles();

      $data['header'] = $this->load->view('templates/header', '', TRUE);
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $data['footer'] = $this->load->view('templates/footer', '', TRUE);
      $this->load->view('admin/' . $page, $data);
    } else {
      redirect('login');
    }
  }
  public function employee($id)
  {
    if ($this->session->is_logged_in) {
      $data['employee'] = $this->em->getEmployee($id);

      $data['header'] = $this->load->view('templates/header', '', TRUE);
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $data['footer'] = $this->load->view('templates/footer', '', TRUE);
      $this->load->view('admin/employee', $data);
    } else {
      redirect('login');
    }
  }
  public function addRole()
  {
    $response = $this->um->addRole();

    exit(json_encode($response));
  }
  public function editUser($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['user'] = $this->um->getUserByID($id);
        $data['roles'] = $this->um->getRoles();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('admin/editUser', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateUser($id)
  {
    $response = $this->um->updateUser($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "User with id : $id is Successfully Updated!");
      redirect('admin/users_management');
    } else {
      $this->session->set_userdata('error_msg', "User is not Updated! Try again Later");
      redirect('admin/users_management');
    }
  }
  public function deleteUser($id)
  {
    $response = $this->um->deleteUser($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "User with id : $id is Successfully Deleted!");
      redirect('admin/users_management');
    } else {
      $this->session->set_userdata('error_msg', "User is not Deleted! Try again Later");
      redirect('admin/users_management');
    }
  }
}
