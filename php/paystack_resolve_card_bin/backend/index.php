<?php
require_once('../vendor/autoload.php');
require('../config.php');

function resolve_card_bin($data){
  $curl = curl_init();
  $bin = $data['bin'];

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/decision/bin/" . $bin,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer " . PAYSTACK_SECRET_KEY,
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
    exit();
  } else {
    return $response;
  }
}



