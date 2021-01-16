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
        return $this->getEmpAttendanceByID($empID, $date);
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
        return $this->getEmpAttendanceByID($empID, $date);
      return FALSE;
      // return $in_outs;
    }
  }
  public function getEmpAttendanceByID($id, $date)
  {
    $this->db->where('empID', $id);
    $this->db->where('date', $date);
    $query = $this->db->get('emp_tran');
    if ($query && $query->num_rows() > 0) {
      $row = $query->row_array();
      $data = $this->em->getEmployee($row['empID']);
      $employee['empID'] = $row['empID'];
      $employee['name'] = $data['name'];
      $employee['in_time'] = $row['in_time'];
      $employee['out_time'] = $row['out_time'];
      $employee['shift'] = $data['shift'];

      return $employee;
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

  /////////////////////////////////////////
  //Visitors
  /////////////////////////////////////////
  public function sendVisitorDetails($in_time)
  {
    $post = $this->input->post();
    $dov_from = date("Y-m-d H:i:s", strtotime($post['date_from'] . " " . $post['time_from']));
    $dov_to = date("Y-m-d H:i:s", strtotime($post['date_to'] . " " . $post['time_to']));
    $data = array(
      'name' => $post['name'],
      'uid' => $post['uid'],
      'v_mobile' => $post['v_mobile'],
      'from_comp' => $post['from_comp'],
      'no_of_people' => $post['no_of_people'],
      'to_meet' => $post['to_meet'],
      'purpose' => $post['purpose'],
      'dov_from' => $dov_from,
      'dov_to' => $dov_to,
      'in_time' => $in_time
    );

    $query = $this->db->insert('visitor_tran', $data);
    if ($query) {
      return array("insert_id" => $this->db->insert_id());
    }
    return FALSE;
  }
  public function getPreviousVisits()
  {
    $this->db->where('v_mobile', $this->input->post('v_mobile'));
    $this->db->from('visitor_tran t1');
    $this->db->order_by('visit_id', "DESC");
    $this->db->join('company t2', 't2.comp_id=t1.from_comp');
    $this->db->join('purpose t3', 't3.purp_id=t1.purpose');
    $query = $this->db->get();
    $visits = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $visit['visit_id'] = $row['visit_id'];
        $visit['location'] = $row['location'];
        $visit['name'] = $row['name'];
        $visit['dov_from'] = $row['dov_from'];
        $visit['dov_to'] = $row['dov_to'];
        $visit['no_of_people'] = $row['no_of_people'];
        $visit['from_comp'] = $row['comp_name'];
        $visit['v_mobile'] = $row['v_mobile'];
        $visit['uid'] = $row['uid'];
        $visit['in_time'] = $row['in_time'];
        $visit['purpose'] = $row['purpose'];
        $visit['to_meet'] = $this->em->getEmployee($row['to_meet'])['name'];
        $visit['to_meet_conf'] = $row['to_meet_conf'];
        $visit['denial_reason'] = $row['denial_reason'];
        $visit['proposed_time'] = $row['proposed_time'];
        $visit['out_time'] = $row['out_time'];
        $visit['photo'] = $row['photo'];

        array_push($visits, $visit);
      }

      return $visits;
    }

    return FALSE;
  }
  public function getPurposes()
  {
    $query = $this->db->get('purpose');

    if ($query && $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }
  public function addPurpose()
  {
    $data = array(
      'purpose' => $this->input->post('purpose')
    );
    $query = $this->db->insert('purpose', $data);
    if ($query) {
      return array('insert_id' => $this->db->insert_id());
    }
    return FALSE;
  }
  public function approveVisit()
  {
    $empID = $this->session->userdata('empID');
    $visitID = $this->input->post('visit_id');

    $this->db->where('to_meet', $empID);
    $this->db->where('visit_id', $visitID);
    $this->db->set('to_meet_conf', MEET_CONFIRMED);
    $query = $this->db->update('visitor_tran');

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function rejectVisit($time)
  {
    $empID = $this->session->userdata('empID');
    $visitID = $this->input->post('visit_id');
    $reason = $this->input->post('reason');

    $this->db->where('to_meet', $empID);
    $this->db->where('visit_id', $visitID);
    $this->db->set('out_time', $time);
    $this->db->set('to_meet_conf', MEET_REJECTED);
    $this->db->set('denial_reason', $reason);
    $query = $this->db->update('visitor_tran');

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function rescheduleVisit()
  {
    $empID = $this->session->userdata('empID');
    $visitID = $this->input->post('visit_id');
    $datetime = $this->input->post('datetime');
    $proposed_time = date("Y-m-d H:i:s", strtotime($datetime));
    $out_time = date('H:i:s');

    $this->db->where('to_meet', $empID);
    $this->db->where('visit_id', $visitID);
    $this->db->set('to_meet_conf', MEET_SCHEDULED);
    $this->db->set('proposed_time', $proposed_time);
    $this->db->set('out_time', $out_time);
    $query = $this->db->update('visitor_tran');

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function finishVisit()
  {
    $empID = $this->session->userdata('empID');
    $visitID = $this->input->post('visit_id');
    $time = date('H:i:s');
    $dov_to = date('Y-m-d H:i:s');

    $this->db->where('to_meet', $empID);
    $this->db->where('visit_id', $visitID);
    $this->db->set('dov_to', $dov_to);
    $this->db->set('out_time', $time);
    $query = $this->db->update('visitor_tran');

    if ($query)
      return TRUE;
    return FALSE;
  }
}
