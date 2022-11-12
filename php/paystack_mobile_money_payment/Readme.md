# ApiKodes Paystack USSD payment Documentation 
This is an open source implementation of paystack’s ussd Api. 
This payment method is only for merchants in GHANA.

The Pay via Mobile Money channel allows Ghanaian customers to pay you by entering the phone number enabled for mobile money.

## AIM 
The aim is to help starters or junior devs implement paystack ussd payment api. 

## Language: 
- PHP

## Installation process
  - clone the project from https://github.com/apiKodesRepo/PaystackPaymentDemo/tree/main/php/paystack_mobile_money_payment
  - rename the existing .env.example to .env file
  - Install the vlucas/phpdotenv to be able to use your .env variables
    - check our the documentation here https://github.com/vlucas/phpdotenv
  > $ composer require vlucas/phpdotenv
  - register on paystack
  - get your paystack keys i.e public and secret from your dashboard https://dashboard.paystack.com/#/settings/developer
  - add your api keys in the .env file 

  
## File Structure
  - backend 
    - index.php
  - frontend 
    - index.php
    - style.css
  - .env.example 
  - composer.json *you can easily run **composer install***
  - config.php
  - README.md

## Need for Volunteers 
We need people that can implement paystack's api in various programming languages. 
please reach out to us on *info@apikodes.com* or +2349015222109

*Note: All implementations are the implementor’s method of using paystack’s api*

Documentation url: https://paystack.com/docs/payments/payment-channels/#mobile-money