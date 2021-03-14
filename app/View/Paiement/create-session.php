<?php
session_start();


$prix_total=$_SESSION["prix_total"]* 100; //conversion pour le unit_amount ci-dessous, qui n'accepte pas les virgules


require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8080';

$checkout_session = \Stripe\Checkout\Session::create([

  'payment_method_types' => ['card'],
  


    'line_items' => [[

      'price_data' => [
  
        'currency' => 'eur',
  
        'unit_amount' => $prix_total,
  
        'product_data' => [
  
          'name' => "Votre total",

          
  
  
        ],
  
      ],

      'quantity' => 1,
  
  
    ]],

  

  

  'mode' => 'payment',

  'success_url' => $YOUR_DOMAIN . '/success.html',

  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',

]);

echo json_encode(['id' => $checkout_session->id]);