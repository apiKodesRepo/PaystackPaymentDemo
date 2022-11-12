<?php
require_once('../vendor/autoload.php');
require('../config.php');

// Guaranty Trust Bank	737
// United Bank of Africa	919
// Sterling Bank	822
// Zenith Bank	966

function ussd_payment($data)
{
  // $data = [
  //   "email" => "hello@gmail.com", 
  //   "amount" => "10000",
  //   "ussd" => [ 
  //     "type"=> "737" 
  //   ],
  //   "metadata"=> [
  //     "custom_fields"=>[
  //       "value"=> "Happy family",
  //       "display_name"=> "Donation for ",
  //       "variable_name"=> "donation_for"
  //     ]
  //   ]
  // ];

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/charge",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer " . PAYSTACK_SECRET_KEY,
      "Content-Type: application/json"
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  

  if ($err) {
    curl_close($curl);
    return false;
  } else {
    curl_close($curl);
    return $response;
  }
}

// ussd_payment();
