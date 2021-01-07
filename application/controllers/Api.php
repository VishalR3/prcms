<?php

class Api extends CI_Controller
{

  public function addShift()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addShift();
    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addCompany()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addCompany();
    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addLocation()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addLocation();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addContractor()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addContractor();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addDepartment()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addDepartment();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
  public function addHoliday()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }

    $response = $this->mm->addHoliday();

    if ($response) {
      exit(json_encode($response));
    }
    return FALSE;
  }
}
