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
      'status' => $this->input->post('status'),
      'cont' => $this->input->post('cont'),
      'active' => $this->input->post('active'),
      'mobile' => $this->input->post('mobile'),
      'vehcle_number' => $this->input->post('vehicle_number'),
      'license' => $this->input->post('license'),
      'emission_exp' => $this->input->post('emisson_exp'),
      'email' => $this->input->post('email'),
      'photo' => $this->input->post('photo'),
    );
    if ($this->db->insert('employee', $data))
      return TRUE;
    return FALSE;
  }
}
