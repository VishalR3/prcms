<?php

class Api extends CI_Controller
{

  public function addShift()
  {

    $response = $this->am->addShift();
    if ($response) {
      return TRUE;
    }
    return FALSE;
  }
}
