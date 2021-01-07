<?php

class Pages extends CI_Controller
{

  public function view($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
      show_404();
    }

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/' . $page, $data);
  }

  public function masters($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/masters/' . $page . '.php')) {
      show_404();
    }

    $data['shifts'] = $this->am->getShifts();

    $data['header'] = $this->load->view('templates/header', '', TRUE);
    $data['links'] = $this->load->view('templates/links', '', TRUE);
    $data['scripts'] = $this->load->view('templates/scripts', '', TRUE);
    $data['footer'] = $this->load->view('templates/footer', '', TRUE);
    $this->load->view('pages/masters/' . $page, $data);
  }
}
