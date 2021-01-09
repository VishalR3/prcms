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
}
