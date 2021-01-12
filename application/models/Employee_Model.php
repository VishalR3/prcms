<?php

class Employee_Model extends CI_Model
{

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
}
