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
    $this->load->library('Twilio');

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
      $date = date('Y-m-d');
      $in_time = date('H:i:s');
      $response = $this->am->sendVisitorDetails($date, $in_time);

      if ($response) {
        $msg = 'Hello ' . $response['empName'] . ', ' . $response['visitor'] . ' wants to meet you at ' . $response['date'] . ' with ' . $response['people'] . ' people. Purpose : ' . $response['purpose'] . '  Visit ID : ' . $response['insert_id'];
        $mobile = '+91' . $response['empMobile'];
        $response['msgdata'] = $this->twilio->sendSMS($mobile, $msg);
        exit(json_encode($response));
      }
      exit(FALSE);
    }
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
  public function getVisitorReports()
  {
    $date = date('Y-m-d');
    $response = $this->am->getVisitorReports($date);

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
  public function getVisitorReportsDateRange()
  {
    $from = date("Y-m-d", strtotime($this->input->post('from')));
    $to = date("Y-m-d", strtotime($this->input->post('to')));
    $response = $this->am->getVisitorReportsDateRange($from, $to);
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
  public function searchContractor()
  {
    $term = $this->input->post('term');

    $response = $this->mm->searchContractor($term);
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
    $this->output->set_content_type('application/pdf');
    $file = $pdf->output('report/report.pdf', 'F');
    exit($file);
  }

  public function approveVisit()
  {
    $response = $this->am->approveVisit();

    $this->echoJsonResponse($response);
  }
  public function rejectVisit()
  {
    $time = date('H:i:s');
    $response = $this->am->rejectVisit($time);

    $this->echoJsonResponse($response);
  }
  public function rescheduleVisit()
  {
    $response = $this->am->rescheduleVisit();

    $this->echoJsonResponse($response);
  }
  public function finishVisit()
  {
    $response = $this->am->finishVisit();

    $this->echoJsonResponse($response);
  }

  public function uploadEmployeePhoto()
  {
    $response = $this->em->uploadEmployeePhoto();

    $this->echoJsonResponse($response);
  }
  public function getFaceDescriptors()
  {
    $response = $this->em->getFaceDescriptors();

    $this->echoJsonResponse($response);
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
  public function postVisitorAttendance()
  {
    $time = date('H:i:s');
    $date = date('Y-m-d');
    $visitor['visitor'] = TRUE;
    $visitor['time'] = $time;
    $visitor['date'] = $date;

    $factory = (new Factory())->withDatabaseUri('https://prcms-6f25b-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();

    $liveCam = $database->getReference('liveCam');
    $liveCam->set(NULL);
    $liveCam->push($visitor);

    $this->echoJsonResponse(TRUE);
  }
}
