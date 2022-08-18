<?php
    require('config.php');
    // only a post with paystack signature header gets our attention
    if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') || !array_key_exists('x-paystack-signature', $_SERVER))
        exit();

    // Retrieve the request's body
    $input = @file_get_contents("php://input");

    // validate event do all at once to avoid timing attack
    if ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
        exit();

    http_response_code(200);

    // parse event (which is json string) as object
    // Do something - that will not take long - with $event
    $event = json_decode($input);

    // from here we can save the response to our database 
    