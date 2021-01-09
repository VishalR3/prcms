<?php

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Kolkata');
  }

  private function echoJsonResponse($response)
  {
    $this->output->set_content_type('application/json');
    $data['jsonResponse'] = json_encode($response);
    $this->load->view('api/api_response', $data);
  }
  public function addShift()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addShift();
    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addCompany()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addCompany();
    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addLocation()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addLocation();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addContractor()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addContractor();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addDepartment()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addDepartment();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addHoliday()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addHoliday();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addEmployee()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->em->addEmployee();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }

  //Read API
  public function getLocations()
  {
    $response = $this->mm->getLocations();

    $this->echoJsonResponse($response);
  }
  public function getEmployees()
  {
    $response = $this->em->getEmployees();
    $this->echoJsonResponse($response);
  }
  public function getEmpAttendance()
  {
    $date = date('Y-m-d');
    $response = $this->am->getEmpAttendance($date);

    $this->echoJsonResponse($response);
  }
  public function getEmpReports()
  {
    $date = date('Y-m-d');
    $response = $this->am->getEmpReports($date);

    $this->echoJsonResponse($response);
  }
  public function getEmpReportsDateRange()
  {
    $from = date("Y-m-d", strtotime($this->input->post('from')));
    $to = date("Y-m-d", strtotime($this->input->post('to')));
    $response = $this->am->getEmpReportsDateRange($from, $to);
    $this->echoJsonResponse($response);
  }

  //Python
  public function postEmployeeAttendance()
  {
    $empID = $this->input->post('empID');
    $time = date('h:i:s');
    $date = date('Y-m-d');
    $timezone = date_default_timezone_get();

    $response['data'] = $this->am->employeeAttendance($empID, $time, $date);
    $response['empID'] = $empID;
    $response['time'] = $time;
    $response['date'] = $date;
    $response['timezone'] = $timezone;

    $this->echoJsonResponse($response);
  }
}
