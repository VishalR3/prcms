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

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('admin/' . $page, $data);
  }
  public function employee($id)
  {
    $data['employee'] = $this->am->getEmployee($id);

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('admin/employee', $data);
  }
}
