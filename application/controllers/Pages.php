<?php

class Pages extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Kolkata');
  }
  public function view($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
      show_404();
    }

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/' . $page, $data);
  }

  public function masters($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/masters/' . $page . '.php')) {
      show_404();
    }

    $data['shifts'] = $this->mm->getShifts();
    $data['companies'] = $this->mm->getCompanies();
    $data['locations'] = $this->mm->getLocations();
    $data['contractors'] = $this->mm->getContractors();
    $data['departments'] = $this->mm->getDepartments();
    $data['holidays'] = $this->mm->getHolidays();
    $data['employees'] = $this->em->getEmployees();

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/masters/' . $page, $data);
  }
  public function reports($page)
  {
    if (!file_exists(APPPATH . 'views/pages/reports/' . $page . '.php')) {
      show_404();
    }
    $data['companies'] = $this->mm->getCompanies();
    $data['locations'] = $this->mm->getLocations();
    $data['departments'] = $this->mm->getDepartments();

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/reports/' . $page, $data);
  }
  public function visitor($page)
  {
    if (!file_exists(APPPATH . 'views/pages/visitor/' . $page . '.php')) {
      show_404();
    }

    $data['contractors'] = $this->mm->getContractors();

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/visitor/' . $page, $data);
  }
}
