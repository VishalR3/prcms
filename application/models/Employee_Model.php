<?php

class Employee_Model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Kolkata');
  }

  public function addEmployee()
  {
    $data = array(
      'name' => $this->input->post('name'),
      'location' => $this->input->post('location'),
      'shift' => $this->input->post('shift'),
      'dept' => $this->input->post('dept'),
      'status' => $this->input->post('status'),
      'active' => '1',
      'email' => $this->input->post('email'),
      'mobile' => $this->input->post('mobile'),
    );
    if ($this->input->post('status')) {
      $data['cont'] = $this->input->post('cont');
    }
    if ($this->input->post('vehicle_number'))
      $data['vehicle_number'] = $this->input->post('vehicle_number');
    if ($this->input->post('license'))
      $data['license'] = $this->input->post('license');
    if ($this->input->post('emission_exp'))
      $data['emission_exp'] = $this->input->post('emission_exp');
    if ($this->input->post('photo'))
      $data['photo'] = $this->input->post('photo');


    if ($this->db->insert('employee', $data))
      return $this->db->insert_id();
    return FALSE;
  }
  public function getEmployees()
  {
    $this->db->where('active', 1);
    $query = $this->db->get("employee");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
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
  public function searchEmployee($term)
  {

    $this->db->like('name', $term, 'both');
    $query = $this->db->get('employee');

    $employees = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $employee = $this->getEmployee($row['empID']);

        array_push($employees, $employee);
      }

      return $employees;
    }
    return FALSE;
  }
  public function updateEmployee($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    if ($this->input->post('status') == '0') {
      unset($data['cont']);
    }
    $this->db->where('empID', $id);
    $query = $this->db->update("employee", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteEmployee($id)
  {

    $this->db->where('empID', $id);
    $query = $this->db->delete("employee");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getEmployeeByID($id)
  {
    $this->db->where('empID', $id);
    $query = $this->db->get("employee");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
    return FALSE;
  }
  public function getPendingMeets($empID)
  {
    $meets = array();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', NULL);
    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }

    return $meets;
  }
  public function getScheduledMeets($empID)
  {
    $meets = array();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', MEET_CONFIRMED);
    $this->db->where('dov_to >', date('Y-m-d H:i:s'));
    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }
    $this->db->reset_query();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', MEET_SCHEDULED);
    $this->db->where('proposed_time >', date('Y-m-d H:i:s'));

    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }

    return $meets;
  }
  public function getFinishedMeets($empID)
  {
    $meets = array();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', MEET_CONFIRMED);
    $this->db->where('dov_to <=', date('Y-m-d H:i:s'));
    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }
    $this->db->reset_query();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', MEET_SCHEDULED);
    $this->db->where('proposed_time <', date('Y-m-d H:i:s'));

    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }
    $this->db->reset_query();
    $this->db->from('visitor_tran t1');
    $this->db->where('to_meet', $empID);
    $this->db->where('to_meet_conf', MEET_REJECTED);

    $this->db->join('purpose t2', 't2.purp_id=t1.purpose');
    $query = $this->db->get();

    if ($query && $query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        array_push($meets, $row);
      }
    }

    return $meets;
  }
}
