<?php

use Kreait\Firebase\Factory;

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Kolkata');
    $this->load->library('form_validation');
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
  public function addPurpose()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->am->addPurpose();

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


    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    $this->form_validation->set_rules('shift', 'Shift', 'required');
    $this->form_validation->set_rules('dept', 'Department', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[13]|is_unique[employee.mobile]');
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

  public function sendVisitorDetails()
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('no_of_people', 'No. of People', 'required');
    $this->form_validation->set_rules('to_meet', 'Employee To Meet', 'required');
    $this->form_validation->set_rules('date_from', 'Date From', 'required');
    $this->form_validation->set_rules('time_from', 'Time From', 'required');
    if ($this->form_validation->run() == FALSE) {
      $response['success'] = FALSE;
      $response['errors'] = validation_errors();

      exit(json_encode($response));
    } else {
      $in_time = date('H:i:s');
      $response = $this->am->sendVisitorDetails($in_time);

      if ($response)
        exit(json_encode($response));
      exit(FALSE);
    }
  }
  public function sendMeetAlerts()
  {
    $factory = (new Factory())->withDatabaseUri('https://prcms-6f25b-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();

    $meets = $database->getReference('meets');
    $visit_data = array(
      'to_meet' => $this->input->post('to_meet'),
      'purpose' => $this->input->post('purpose'),
      'visit_id' => $this->input->post('visit_id')
    );
    $meets->push($visit_data);
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
  public function getPreviousVisits()
  {
    $response = $this->am->getPreviousVisits();

    if ($response)
      exit(json_encode($response));
    exit(FALSE);
  }
  public function makePDF()
  {
    $pdf = new \Mpdf\Mpdf();
    $pdf->WriteHTML($this->input->post('html'));
    $pdf->output('reports/report.pdf', \Mpdf\Output\Destination::FILE);
  }


  //Python
  public function postEmployeeAttendance()
  {
    $empID = $this->input->post('empID');
    $time = date('H:i:s');
    $date = date('Y-m-d');
    $timezone = date_default_timezone_get();

    $response['data'] = $this->am->employeeAttendance($empID, $time, $date);
    $response['timezone'] = $timezone;
    $employee = $response['data'];

    $factory = (new Factory())->withDatabaseUri('https://prcms-6f25b-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $date = $database->getReference('date');
    if ($date->getValue() != date('d/m/Y')) {
      //New Day
      $date->set(date('d/m/Y'));
      $response['day'] = "New Day";
      $today = $database->getReference('today');
      $today->set(NULL);
      $today->push($employee);
    } else {
      //Old Day
      $response['day'] = "Old Day";
      $today = $database->getReference('today');
      $snap = $today->orderByKey()->getSnapshot()->getValue();
      foreach ($snap as $key => $value) {
        if ($empID == $value['empID']) {
          $today->getChild($key)->set(NULL);
        }
      }
      $today->push($employee);
    }
    $liveCam = $database->getReference('liveCam');
    $liveCam->set(NULL);
    $liveCam->push($employee);

    $this->echoJsonResponse($response);
  }
}
