<?php

class Attendance_Model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }


  // Marking Employees Attendance
  public function employeeAttendance($empID, $time, $date)
  {
    $this->db->where('empID', $empID);
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query->num_rows() == 0) {
      $in_outs = array(
        'times' => '1',
        'in' => array($time),
        'out' => array()
      );
      $data = array(
        'empID' => $empID,
        'in_time' => $time,
        'date' => $date,
        'in_outs' => json_encode($in_outs)
      );
      $this->db->reset_query();
      if ($this->db->insert('emp_tran', $data))
        return TRUE;
      return FALSE;
    } else {
      $row = $query->row_array();
      $in_outs = json_decode($row['in_outs']);
      if ($in_outs->times % 2 != 0) {
        $in_outs->times += 1;
        array_push($in_outs->out, $time);
        $data = array(
          'out_time' => $time,
          'in_outs' => json_encode($in_outs)
        );
      } else {
        $in_outs->times += 1;
        array_push($in_outs->in, $time);
        $data = array(
          'in_outs' => json_encode($in_outs)
        );
      }
      $this->db->reset_query();
      $this->db->where('empID', $empID);
      if ($this->db->update('emp_tran', $data))
        return TRUE;
      return FALSE;
      // return $in_outs;
    }
  }
  public function getEmpAttendance($date)
  {
    $employees = array();
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $employee['tran_id'] = $row['tran_id'];
        $data = $this->em->getEmployee($row['empID']);
        foreach ($data as $key => $value) {
          $employee[$key] = $value;
        }
        $employee['date'] = $row['date'];
        $employee['in_time'] = $row['in_time'];
        $employee['out_time'] = $row['out_time'];
        $employee['in_outs'] = json_decode($row['in_outs']);

        array_push($employees, $employee);
      }
      return $employees;
    }
    return FALSE;
  }

  public function getEmpReports($date)
  {
    $employees = array();
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data = $this->em->getEmployee($row['empID']);
        $employee['empID'] = $row['empID'];
        $employee['name'] = $data['name'];
        $employee['location'] = $data['location'];
        $employee['shift'] = $data['shift'];
        $employee['department'] = $data['dept'];
        $employee['mobile'] = $data['mobile'];
        $employee['date'] = date("d/m/Y", strtotime($row['date']));
        $employee['in_time'] = $row['in_time'];
        $employee['out_time'] = $row['out_time'];
        if ($row['out_time'] == "00:00:00") {
          $employee['total_hrs_spent'] = date_diff(date_create($row['in_time']), date_create(date('H:i:s')))->format('%h h %i min');
        } else {
          $employee['total_hrs_spent'] = date_diff(date_create($row['out_time']), date_create($row['in_time']))->format('%h h %i min');
        }

        array_push($employees, $employee);
      }
      return $employees;
    }
    return FALSE;
  }
  public function getEmpReportsForHome($date)
  {
    $employees = array();
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data = $this->em->getEmployee($row['empID']);
        $employee['empID'] = $row['empID'];
        $employee['name'] = $data['name'];
        $employee['in_time'] = $row['in_time'];
        $employee['out_time'] = $row['out_time'];

        array_push($employees, $employee);
      }
      return $employees;
    }
    return FALSE;
  }
  public function getEmpReportsDateRange($from, $to)
  {
    $loc_filter = $this->input->post('loc_filter');
    $dept_filter = $this->input->post('dept_filter');
    $employees = array();
    $this->db->where('date >=', $from);
    $this->db->where('date <=', $to);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data = $this->em->getEmployee($row['empID']);
        if ($loc_filter != $data['location'] && $loc_filter != 'all') {
          continue;
        } else if ($dept_filter != $data['dept'] && $dept_filter != 'all') {
          continue;
        } else {
          $employee['empID'] = $row['empID'];
          $employee['name'] = $data['name'];
          $employee['location'] = $data['location'];
          $employee['shift'] = $data['shift'];
          $employee['department'] = $data['dept'];
          $employee['mobile'] = $data['mobile'];
          $employee['date'] = date("d/m/Y", strtotime($row['date']));
          $employee['in_time'] = $row['in_time'];
          $employee['out_time'] = $row['out_time'];
          $employee['total_hrs_spent'] = date_diff(date_create($row['out_time']), date_create($row['in_time']))->format('%h h %i min');


          array_push($employees, $employee);
        }
      }
    }
    return $employees;
  }
}
