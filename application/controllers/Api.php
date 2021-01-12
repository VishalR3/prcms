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
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    $this->form_validation->set_rules('shift', 'Shift', 'required');
    $this->form_validation->set_rules('dept', 'Department', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[10]|is_unique[employee.mobile]');
    $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[employee.email]');

    if ($this->form_validation->run() == FALSE) {
      $response['success'] = FALSE;
      $response['errors'] = validation_errors();
      $response['name'] = $this->input->post('name');
    } else {
      $response['empID'] = $this->em->addEmployee();
      $response['success'] = TRUE;
    }


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
  public function getEmpReportsForHome()
  {
    $date = date('Y-m-d');
    $response = $this->am->getEmpReportsForHome($date);

    $this->echoJsonResponse($response);
  }
  public function getEmpReportsDateRange()
  {
    $from = date("Y-m-d", strtotime($this->input->post('from')));
    $to = date("Y-m-d", strtotime($this->input->post('to')));
    $response = $this->am->getEmpReportsDateRange($from, $to);
    $this->echoJsonResponse($response);
  }
  public function searchEmployee()
  {
    $term = $this->input->post('term');

    $response = $this->em->searchEmployee($term);
    if ($response)
      $this->echoJsonResponse($response);

    return FALSE;
  }


  //Python
  public function postEmployeeAttendance()
  {
    $empID = $this->input->post('empID');
    $time = date('H:i:s');
    $date = date('Y-m-d');
    $timezone = date_default_timezone_get();

    $response['data'] = $this->am->employeeAttendance($empID, $time, $date);
    $response['empID'] = $empID;
    $response['time'] = $time;
    $response['date'] = $date;
    $response['timezone'] = $timezone;

    $this->echoJsonResponse($response);
  }
  public function makePDF()
  {
    $pdf = new \Mpdf\Mpdf();
    $pdf->WriteHTML($this->input->post('html'));
    $file = $pdf->output('reports/report.pdf', \Mpdf\Output\Destination::FILE);
  }
}
