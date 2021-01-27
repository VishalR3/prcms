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

    if ($this->session->is_logged_in) {
      $data['companies'] = $this->mm->getCompanies();
      $data['locations'] = $this->mm->getLocations();
      $data['departments'] = $this->mm->getDepartments();
      $data['employeesList'] = $this->em->getEmployeeListByContID();

      $data['header'] = $this->load->view('templates/header', '', TRUE);
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $data['footer'] = $this->load->view('templates/footer', '', TRUE);
      $this->load->view('pages/' . $page, $data);
    } else {
      redirect('login');
    }
  }
  public function login($data = array())
  {

    if ($this->session->is_logged_in) {
      redirect('home');
    } else {

      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $this->load->view('login/login', $data);
    }
  }
  public function first_login($data = array())
  {
    if ($this->session->is_logged_in && $this->session->active == 0) {
      $data['errors'] = '0';
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $this->load->view('login/f_login', $data);
    } else {
      redirect('home');
    }
  }

  public function masters($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/masters/' . $page . '.php')) {
      show_404();
    }
    if ($this->session->is_logged_in) {
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
    } else {
      redirect('login');
    }
  }
  public function reports($page)
  {
    if (!file_exists(APPPATH . 'views/pages/reports/' . $page . '.php')) {
      show_404();
    }
    if ($this->session->is_logged_in) {
      $access = json_decode($this->session->userdata('access'));
      if (in_array('report.read', $access)) {
        $data['contractors'] = $this->mm->getContractors();
        $data['locations'] = $this->mm->getLocations();
        $data['departments'] = $this->mm->getDepartments();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/reports/' . $page, $data);
      } else {
        redirect('error/NoAccess');
      }
    } else {
      redirect('login');
    }
  }
  public function visitor($page)
  {
    if (!file_exists(APPPATH . 'views/pages/visitor/' . $page . '.php')) {
      show_404();
    }
    if ($this->session->is_logged_in) {
      $data['companies'] = $this->mm->getCompanies();
      $data['employees'] = $this->em->getEmployees();
      $data['purposes'] =  $this->am->getPurposes();



      $data['header'] = $this->load->view('templates/header', '', TRUE);
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $data['footer'] = $this->load->view('templates/footer', '', TRUE);
      $this->load->view('pages/visitor/' . $page, $data);
    } else {
      redirect('login');
    }
  }
  public function dashboard()
  {
    if ($this->session->is_logged_in) {
      $empID = $this->session->userdata('empID');
      $data['PendingMeets'] = $this->em->getPendingMeets($empID);
      $data['ScheduledMeets'] = $this->em->getScheduledMeets($empID);
      $data['FinishedMeets'] = $this->em->getFinishedMeets($empID);


      $data['header'] = $this->load->view('templates/header', '', TRUE);
      $data['links'] = $this->load->view('templates/links', '', TRUE);
      $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
      $data['footer'] = $this->load->view('templates/footer', '', TRUE);
      $this->load->view('pages/reports/dashboard', $data);
    } else {
      redirect('login');
    }
  }
}
