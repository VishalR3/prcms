<?php

use Twilio\Rest\Client;

class Twilio
{
  protected $CI;
  // protected $account_sid = 'AC1805f72d329877871e85e8d7c13b0eba';
  // protected $auth_token = '625535946bc39c2b2a0480571864d84a';
  // protected $twilio_number = "+19254034478";

  public function __construct()
  {
    $this->CI = &get_instance();
  }


  public function sendSMS($to, $msg)
  {
    $account_sid = 'AC1805f72d329877871e85e8d7c13b0eba';
    $auth_token = '625535946bc39c2b2a0480571864d84a';
    $twilio_number = "+19254034478";

    $client = new Client($account_sid, $auth_token);

    $message = $client->messages->create(
      $to,
      array(
        'from' => $twilio_number,
        'body' => $msg
      )
    );

    return $message;
  }
}
