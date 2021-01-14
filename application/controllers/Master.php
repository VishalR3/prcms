<?php

class Master extends CI_Controller
{

  public function editHoliday($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['holiday'] = $this->mm->getHolidayByID($id);

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_holiday', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateHoliday($id)
  {
    $response = $this->mm->updateHoliday($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Holiday with id : $id is Successfully Updated!");
      redirect('masters/holiday');
    } else {
      $this->session->set_userdata('error_msg', "Holiday is not Updated! Try again Later");
      redirect('masters/holiday');
    }
  }
  public function deleteHoliday($id)
  {
    $response = $this->mm->deleteHoliday($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Holiday with id : $id is Successfully Deleted!");
      redirect('masters/holiday');
    } else {
      $this->session->set_userdata('error_msg', "Holiday is not Deleted! Try again Later");
      redirect('masters/holiday');
    }
  }
  public function editDepartment($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['department'] = $this->mm->getDepartmentByID($id);
        $data['employees'] = $this->em->getEmployees();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_department', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateDepartment($id)
  {
    $response = $this->mm->updateDepartment($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Department with id : $id is Successfully Updated!");
      redirect('masters/department');
    } else {
      $this->session->set_userdata('error_msg', "Department is not Updated! Try again Later");
      redirect('masters/department');
    }
  }
  public function deleteDepartment($id)
  {
    $response = $this->mm->deleteDepartment($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Department with id : $id is Successfully Deleted!");
      redirect('masters/department');
    } else {
      $this->session->set_userdata('error_msg', "Department is not Deleted! Try again Later");
      redirect('masters/department');
    }
  }
  public function editContractor($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['contractor'] = $this->mm->getContractorByID($id);
        $data['locations'] = $this->mm->getLocations();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_contractor', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateContractor($id)
  {
    $response = $this->mm->updateContractor($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Contractor with id : $id is Successfully Updated!");
      redirect('masters/contractor');
    } else {
      $this->session->set_userdata('error_msg', "Contractor is not Updated! Try again Later");
      redirect('masters/contractor');
    }
  }
  public function deleteContractor($id)
  {
    $response = $this->mm->deleteContractor($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Contractor with id : $id is Successfully Deleted!");
      redirect('masters/contractor');
    } else {
      $this->session->set_userdata('error_msg', "Contractor is not Deleted! Try again Later");
      redirect('masters/contractor');
    }
  }
  public function editShift($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['shift'] = $this->mm->getShiftByID($id);

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_shift', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateShift($id)
  {
    $response = $this->mm->updateShift($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Shift with id : $id is Successfully Updated!");
      redirect('masters/shift');
    } else {
      $this->session->set_userdata('error_msg', "Shift is not Updated! Try again Later");
      redirect('masters/shift');
    }
  }
  public function deleteShift($id)
  {
    $response = $this->mm->deleteShift($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Shift with id : $id is Successfully Deleted!");
      redirect('masters/shift');
    } else {
      $this->session->set_userdata('error_msg', "Shift is not Deleted! Try again Later");
      redirect('masters/shift');
    }
  }
  public function editLocation($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['location'] = $this->mm->getLocationByID($id);

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_location', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateLocation($id)
  {
    $response = $this->mm->updateLocation($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Location with id : $id is Successfully Updated!");
      redirect('masters/location');
    } else {
      $this->session->set_userdata('error_msg', "Location is not Updated! Try again Later");
      redirect('masters/location');
    }
  }
  public function deleteLocation($id)
  {
    $response = $this->mm->deleteLocation($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Location with id : $id is Successfully Deleted!");
      redirect('masters/location');
    } else {
      $this->session->set_userdata('error_msg', "Location is not Deleted! Try again Later");
      redirect('masters/location');
    }
  }
  public function editCompany($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['company'] = $this->mm->getCompanyByID($id);
        $data['locations'] = $this->mm->getLocations();
        $data['contractors'] = $this->mm->getContractors();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_company', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateCompany($id)
  {
    $response = $this->mm->updateCompany($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Company with id : $id is Successfully Updated!");
      redirect('masters/company');
    } else {
      $this->session->set_userdata('error_msg', "Company is not Updated! Try again Later");
      redirect('masters/company');
    }
  }
  public function deleteCompany($id)
  {
    $response = $this->mm->deleteCompany($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Company with id : $id is Successfully Deleted!");
      redirect('masters/company');
    } else {
      $this->session->set_userdata('error_msg', "Company is not Deleted! Try again Later");
      redirect('masters/company');
    }
  }
  public function editEmployee($id)
  {
    if ($this->session->is_logged_in) {
      if ($id) {
        $data['employee'] = $this->em->getEmployeeByID($id);
        $data['locations'] = $this->mm->getLocations();
        $data['contractors'] = $this->mm->getContractors();
        $data['departments'] = $this->mm->getDepartments();
        $data['shifts'] = $this->mm->getShifts();

        $data['header'] = $this->load->view('templates/header', '', TRUE);
        $data['links'] = $this->load->view('templates/links', '', TRUE);
        $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
        $data['footer'] = $this->load->view('templates/footer', '', TRUE);
        $this->load->view('pages/masters/edit_employee', $data);
      } else {
        redirect('home');
      }
    } else {
      redirect('login');
    }
  }
  public function updateEmployee($id)
  {
    $response = $this->em->updateEmployee($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Employee with id : $id is Successfully Updated!");
      redirect('masters/employee');
    } else {
      $this->session->set_userdata('error_msg', "Employee is not Updated! Try again Later");
      redirect('masters/employee');
    }
  }
  public function deleteEmployee($id)
  {
    $response = $this->em->deleteEmployee($id);

    if ($response) {
      $this->session->set_userdata('success_msg', "Employee with id : $id is Successfully Deleted!");
      redirect('masters/employee');
    } else {
      $this->session->set_userdata('error_msg', "Employee is not Deleted! Try again Later");
      redirect('masters/employee');
    }
  }
}
