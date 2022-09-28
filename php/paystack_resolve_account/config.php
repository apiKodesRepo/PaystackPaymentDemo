<?php 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('PAYSTACK_SECRET_KEY', $_ENV['PAYSTACK_SECRET_KEY']);
define('PAYSTACK_PUBLIC_KEY', $_ENV['PAYSTACK_PUBLIC_KEY']);