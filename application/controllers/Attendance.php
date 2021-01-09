<?php

class Attendance extends CI_Controller
{

  public function getEmpAttendance()
  {
    $date = date('Y-m-d');
    $response = $this->am->getEmpAttendance($date);

    exit(json_encode($response));
  }
}
