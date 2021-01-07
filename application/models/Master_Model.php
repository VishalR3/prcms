<?php

class Master_Model extends CI_Model
{



  //CRUD For Shifts 
  //Function for Getting All the Shifts from the Database
  public function getShifts()
  {
    $query = $this->db->get("shift");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a Shift
  public function addShift()
  {
    $data = array(
      'shift_name' => $this->input->post('shift_name'),
      'start' => $this->input->post('start'),
      'end' => $this->input->post('end'),
      'lunch_bk_start' => $this->input->post('lunch_bk_start'),
      'lunch_bk_end' => $this->input->post('lunch_bk_end'),
    );
    if ($this->input->post('other_bk_start') != 'undefined')
      $data['other_bk_start'] = $this->input->post('other_bk_start');
    if ($this->input->post('other_bk_end') != 'undefined')
      $data['other_bk_end'] = $this->input->post('other_bk_end');

    if ($this->db->insert('shift', $data))
      return $this->db->insert_id();
    return FALSE;
  }

  //CRUD For Holiday
  //Function for Getting All the Holidays from the Database
  public function getHolidays()
  {
    $query = $this->db->get("holiday");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a holiday
  public function addHoliday()
  {
    $data = array(
      'name' => $this->input->post('name'),
      'start' => $this->input->post('start'),
      'end' => $this->input->post('end')
    );
    if ($this->db->insert('holiday', $data))
      return $this->db->insert_id();
    return FALSE;
  }

  //CRUD For Department
  //Function for Getting All the Departments from the Database
  public function getDepartments()
  {
    $query = $this->db->get("department");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a Department
  public function addDepartment()
  {
    $data = array(
      'dept_name' => $this->input->post('dept_name'),
      'hod' => $this->input->post('hod'),
      'mob' => $this->input->post('mob')
    );
    if ($this->db->insert('department', $data))
      return $this->db->insert_id();
    return FALSE;
  }

  //CRUD For Location
  //Function for Getting All the Locations from the Database
  public function getLocations()
  {
    $query = $this->db->get("location");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a Location
  public function addLocation()
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    if ($this->db->insert('location', $data))
      return $this->db->insert_id();
    return FALSE;
  }

  //CRUD For Company
  //Function for Getting All the Companies from the Database
  public function getCompanies()
  {
    $query = $this->db->get("company");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a Company 
  public function addCompany()
  {
    $data = array(
      'comp_name' => $this->input->post('comp_name'),
      'address' => $this->input->post('address'),
      'cont_person' => $this->input->post('cont_person'),
      'mobile' => $this->input->post('mobile'),
      'weekly_off' => $this->input->post('weekly_off')
    );
    if ($this->db->insert('company', $data))
      return $this->db->insert_id();
    return FALSE;
  }

  //CRUD For Contractor
  //Function for Getting All the Contractors from the Database
  public function getContractors()
  {
    $query = $this->db->get("contractor");

    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  //Function for Adding a Contractor
  public function addContractor()
  {
    $data = array(
      'cont_name' => $this->input->post('cont_name'),
      'address' => $this->input->post('address'),
      'cont_person_name' => $this->input->post('cont_person_name'),
      'mobile' => $this->input->post('mobile'),
      'email' => $this->input->post('email'),
      'active' => $this->input->post('active')
    );
    if ($this->db->insert('contractor', $data))
      return $this->db->insert_id();
    return FALSE;
  }
}
