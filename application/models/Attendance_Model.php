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
      return TRUE;
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
      return TRUE;
    return FALSE;
  }
  //Function for Adding a Location
  public function addLocation()
  {
    $data = array(
      'loc_name' => $this->input->post('loc_name'),
      'loc_address' => $this->input->post('loc_address')
    );
    if ($this->db->insert('location', $data))
      return TRUE;
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
      'weekly_off' > $this->input->post('weekly_off')
    );
    if ($this->db->insert('company', $data))
      return TRUE;
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
      'active' > $this->input->post('active')
    );
    if ($this->db->insert('contractor', $data))
      return TRUE;
    return FALSE;
  }
}
