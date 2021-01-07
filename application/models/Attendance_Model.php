<?php

class Attendance_Model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  // Marking Employees Attendance
  public function employeeAttendance($id, $time, $date)
  {
    $this->db->where('empID', $id);
    $this->db->where('date', $date);
    if ($this->db->count_all_results('emp_tran') == 0) {
      $data = array(
        'empID' => $id,
        'in_time' => $time,
        'date' => $date
      );
      $this->db->reset_query();
      if ($this->db->insert('emp_tran', $data))
        return TRUE;
      return FALSE;
    } else {
      $data = array(
        'empID' => $id,
        'out_time' => $time,
        'date' => $date
      );
      $this->db->reset_query();
      $this->db->where('empID', $id);
      if ($this->db->update('emp_tran', $data))
        return TRUE;
      return FALSE;
    }
  }
}
