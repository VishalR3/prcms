<?php


class Socket extends CI_Controller
{

  public function index()
  {
    $this->load->library('Ratchet_client');

    $this->ratchet_client->run();
  }
}
