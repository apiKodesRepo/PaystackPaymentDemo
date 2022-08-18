
# ApiKodes Paystack Documentation 

This is an open source implementation of paystack’s cakephp-paystack

## Aim 

The aim is to help starters or junior devs understand and implement paystack api's with cakephp

## Language: 
  - PHP (CakePHP)

## Installation process
  - clone the project from https://github.com/apiKodesRepo/PaystackPaymentDemo/tree/main/php/cakephp-paystack
  - rename the existing .env.example to .env file
  - Install the vlucas/phpdotenv to be able to use your .env variables
    - check our the documentation here https://github.com/vlucas/phpdotenv
  > $ composer require vlucas/phpdotenv
  - register on paystack
  - get your paystack keys i.e public and secret from your dashboard https://dashboard.paystack.com/#/settings/developer
  - add your api keys in the .env file 

  
## File Structure
  - frontend 
    - index.php
    - style.css
  - .env.example 
  - composer.json *you can easily run **composer install***
  - config.php
  - index.php 
  - README.md
  - webhook-default.php (default implementation of webhook with cakephp)
  - webhook.php (paystack implementation of webhook with cakephp)

## Need for Volunteers 
We need people that can implement paystack's api in various programming languages. 
please reach out to us on *info@apikodes.com*

*Note: All implementations are the implementor’s method of using paystack’s api*

Documentation url: https://paystack.com/docs/
