# ApiKodes Paystack Validate Customer Documentation 

This is an open source implementation of paystack’s validate customer Api.

This is only required if you're using the <a href="https://paystack.com/docs/payments/dedicated-virtual-accounts">Dedicated Virtual Accounts</a> feature and your business falls under any of these categories - Betting, Financial services, and General Services.

## AIM 
The aim is to help starters or junior devs implement paystack validate customer api. 

## Language: 
- PHP

## Installation process
  - clone the project from https://github.com/apiKodesRepo/PaystackPaymentDemo/tree/main/php/paystack_validate_customer
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

Documentation url: https://paystack.com/docs/identity-verification/validate-customer