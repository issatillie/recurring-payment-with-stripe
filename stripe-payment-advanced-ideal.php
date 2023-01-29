<?php

// Load Stripe library
require_once 'stripe-php/init.php';

// Set your secret key
\Stripe\Stripe::setApiKey("sk_test_your_stripe_secret_key");

// Get customer information
$customer_email = $_POST['email'];
$payment_method = $_POST['payment_method'];

// Create a customer
$customer = \Stripe\Customer::create(array(
  "email" => $customer_email,
));

if ($payment_method == "credit_card") {
  // Get credit card token
  $token = $_POST['stripeToken'];

  // Attach the credit card to the customer
  $card = \Stripe\PaymentMethod::create(array(
    "type" => "card",
    "card" => $token,
    "customer" => $customer->id,
  ));

  // Create a subscription for the customer
  $subscription = \Stripe\Subscription::create(array(
    "customer" => $customer->id,
    "items" => array(
      array(
        "plan" => "your_plan_id",
      ),
    ),
    "default_payment_method" => $card->id,
  ));
} else if ($payment_method == "ideal") {
  // Get iDeal bank information
  $ideal_bank = $_POST['ideal_bank'];

  // Attach the iDeal bank to the customer
  $ideal = \Stripe\PaymentMethod::create(array(
    "type" => "ideal",
    "ideal" => array(
      "bank" => $ideal_bank,
    ),
    "customer" => $customer->id,
  ));

  // Create a subscription for the customer
  $subscription = \Stripe\Subscription::create(array(
    "customer" => $customer->id,
    "items" => array(
      array(
        "plan" => "your_plan_id",
      ),
    ),
    "default_payment_method" => $ideal->id,
  ));
}

// If subscription is successfully created, update database table
if ($subscription->status == "active") {
  // Connect to database
  $conn = new mysqli("host", "username", "password", "dbname");

  // Update customer information in database table
  $sql = "UPDATE customers SET stripe_customer_id = '" . $customer->id . "', subscription_id = '" . $subscription->id . "' WHERE email = '" . $customer_email . "'";
  $conn->query($sql);

  // Close connection
  $conn->close();
}

?>
