<?php

class Attendance extends CI_Controller
{

  public function Employee_Attendance()
  {
    $id = $this->input->post('empId');
    $time = $this->input->post('time');
    $date = $this->input->post('date');
    $data['response'] = $this->am->employeeAttendance($id, $time, $date);
  }
}
