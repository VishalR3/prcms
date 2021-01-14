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
  public function updateShift($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('shift_id', $id);
    $query = $this->db->update("shift", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteShift($id)
  {

    $this->db->where('shift_id', $id);
    $query = $this->db->delete("shift");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getShiftByID($id)
  {
    $this->db->where('shift_id', $id);
    $query = $this->db->get("shift");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
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
  public function getHolidayByID($id)
  {
    $this->db->where('_id', $id);
    $query = $this->db->get("holiday");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
    return FALSE;
  }
  public function updateHoliday($id)
  {
    $post = $this->input->post();
    foreach ($post as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('_id', $id);
    $query = $this->db->update("holiday", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteHoliday($id)
  {

    $this->db->where('_id', $id);
    $query = $this->db->delete("holiday");

    if ($query)
      return TRUE;
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
  public function updateDepartment($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('dept_id', $id);
    $query = $this->db->update("department", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteDepartment($id)
  {

    $this->db->where('dept_id', $id);
    $query = $this->db->delete("department");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getDepartmentByID($id)
  {
    $this->db->where('dept_id', $id);
    $query = $this->db->get("department");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
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
  public function updateLocation($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('loc_id', $id);
    $query = $this->db->update("location", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteLocation($id)
  {

    $this->db->where('loc_id', $id);
    $query = $this->db->delete("location");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getLocationByID($id)
  {
    $this->db->where('loc_id', $id);
    $query = $this->db->get("location");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
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
    $this->db->from('company t1');
    $this->db->join('location t2', 't2.loc_id=t1.address');
    $this->db->join('contractor t3', 't3.cont_id=t1.cont_person');
    $query = $this->db->get();
    $companies = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $company['comp_id'] = $row['comp_id'];
        $company['comp_name'] = $row['comp_name'];
        $company['address'] = $row['loc_name'];
        $company['cin'] = $row['cin'];
        $company['cont_person'] = $row['cont_person_name'];
        $company['mobile'] = $row['mobile'];
        $company['weekly_off'] = $row['weekly_off'];

        array_push($companies, $company);
      }
      return $companies;
    }
    return FALSE;
  }
  public function updateCompany($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('comp_id', $id);
    $query = $this->db->update("company", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteCompany($id)
  {

    $this->db->where('comp_id', $id);
    $query = $this->db->delete("company");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getCompanyByID($id)
  {
    $this->db->where('comp_id', $id);
    $query = $this->db->get("company");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
    return FALSE;
  }
  //Function for Adding a Company 
  public function addCompany()
  {
    $data = array(
      'comp_name' => $this->input->post('comp_name'),
      'address' => $this->input->post('address'),
      'cin' => $this->input->post('cin'),
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
    $this->db->from('contractor t1');
    $this->db->join('location t2', 't2.loc_id=t1.address');
    $query = $this->db->get();

    $contractors = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $contractor['cont_id'] = $row['cont_id'];
        $contractor['cont_name'] = $row['cont_name'];
        $contractor['address'] = $row['loc_name'];
        $contractor['full_address'] = $row['loc_address'];
        $contractor['cont_person_name'] = $row['cont_person_name'];
        $contractor['mobile'] = $row['mobile'];
        $contractor['email'] = $row['email'];
        $contractor['active'] = $row['active'];

        array_push($contractors, $contractor);
      }
      return $contractors;
    }
    return FALSE;
  }
  public function updateContractor($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('cont_id', $id);
    $query = $this->db->update("contractor", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteContractor($id)
  {

    $this->db->where('cont_id', $id);
    $query = $this->db->delete("contractor");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getContractorByID($id)
  {
    $this->db->where('cont_id', $id);
    $query = $this->db->get("contractor");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
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
