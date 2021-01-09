<?php

class Attendance_Model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
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
        $data = $this->getEmployee($row['empID']);
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
  public function getEmployee($id)
  {
    $this->db->from('employee t1');
    $this->db->where('empID', $id);
    $this->db->join('shift t2', 't2.shift_id=t1.shift');
    $this->db->join('location t3', 't3.loc_id=t1.location');
    $this->db->join('department t4', 't4.dept_id=t1.dept');
    $query = $this->db->get();
    $query = $query->row_array();
    $employee['empID'] = $query['empID'];
    $employee['name'] = $query['name'];
    $employee['email'] = $query['email'];
    $employee['mobile'] = $query['mobile'];
    $employee['location'] = $query['loc_name'];
    $employee['shift'] = $query['shift_name'];
    $employee['dept'] = $query['dept_name'];
    $employee['status'] = $query['status'] ? 'P' : 'C';
    $employee['active'] = $query['active'] ? 'active' : 'deactivated';
    $employee['vehicle_number'] = $query['vehicle_number'];
    $employee['license'] = $query['license'];
    $employee['emission_exp'] = $query['emission_exp'];
    $employee['photo'] = $query['photo'];

    return $employee;
  }
  public function getEmpReports($date)
  {
    $employees = array();
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data = $this->getEmployee($row['empID']);
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
      return $employees;
    }
    return FALSE;
  }
}
