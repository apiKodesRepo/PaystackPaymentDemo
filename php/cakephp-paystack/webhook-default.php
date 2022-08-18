<?php
    // Retrieve the request's body and parse it as JSON
    $input = @file_get_contents("php://input");
    $event = json_decode($input);
    // Do something with $event
    http_response_code(200); // PHP 5.4 or greater
    