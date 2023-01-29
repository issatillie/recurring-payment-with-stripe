<?php

// Load Stripe library
require_once 'stripe-php/init.php';

// Set your secret key
\Stripe\Stripe::setApiKey("sk_test_your_stripe_secret_key");

// Get customer information
$customer_email = $_POST['email'];
$token = $_POST['stripeToken'];

// Create a customer
$customer = \Stripe\Customer::create(array(
  "email" => $customer_email,
  "source" => $token,
));

// Create a subscription for the customer
$subscription = \Stripe\Subscription::create(array(
  "customer" => $customer->id,
  "items" => array(
    array(
      "plan" => "your_plan_id",
    ),
  ),
));

// If subscription is successfully created, update database table
if ($subscription->status == "active") {
  // Connect to database
  $conn = new mysqli("host", "username", "password", "dbname");

  // Update customer information in database table
  $sql = "UPDATE customers SET stripe_customer_id = '" . $customer->id . "', subscription_id = '" . $subscription->id . "' WHERE email = '" . $customer_email . "'";
  $conn->query($sql);

  // Close database connection
  $conn->close();
}

?>
