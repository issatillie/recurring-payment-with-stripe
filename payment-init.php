<?php
// 1. include the Stripe PHP library
require_once 'stripe-php/init.php';

// 2. Set your secret key
\Stripe\Stripe::setApiKey("sk_test_your_secret_key");

// 3. Get the customer and subscription id from the client-side
$customer_id = $_POST['customer_id'];
$plan_id = $_POST['plan_id'];

try {
  // 4. Create a new subscription for the customer
  $subscription = \Stripe\Subscription::create([
    'customer' => $customer_id,
    'items' => [['plan' => $plan_id]],
    'expand' => ['latest_invoice.payment_intent']
  ]);

  // 5. Check if the payment was successful
  if ($subscription->status == 'active') {
    // 6. Connect to the database and update the customer's information
    $conn = new mysqli("host", "user", "password", "database");
    $sql = "UPDATE customers SET subscription_id='".$subscription->id."', subscription_status='active' WHERE customer_id='".$customer_id."'";
    $conn->query($sql);
    $conn->close();
    
    // 7. Return success message to the client
    echo json_encode(["message" => "Subscription created and database updated successfully."]);
  } else {
    // 8. Return error message to the client
    echo json_encode(["error" => "Payment failed. Please try again later."]);
  }
} catch (Exception $e) {
  // 9. Return error message to the client
  echo json_encode(["error" => $e->getMessage()]);
}

?>
