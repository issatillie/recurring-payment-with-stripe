<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey("sk_test_your_stripe_secret_key");

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['ideal'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => 'Subscription',
      ],
      'unit_amount' => 1000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
  'success_url' => 'https://your-website.com/success',
  'cancel_url' => 'https://your-website.com/cancel',
]);

echo '<script src="https://js.stripe.com/v3/"></script>
  <button id="checkout-button-sku_your_sku_id">Subscribe</button>
  <script>
    var stripe = Stripe("pk_test_your_stripe_publishable_key");
    var checkoutButton = document.getElementById("checkout-button-sku_your_sku_id");
    checkoutButton.addEventListener("click", function () {
      stripe.redirectToCheckout({
        sessionId: "' . $session->id . '"
      });
    });
  </script>';
?>

<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey("sk_test_your_stripe_secret_key");

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['ideal'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => 'Subscription',
      ],
      'unit_amount' => 1000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
  'success_url' => 'https://your-website.com/success',
  'cancel_url' => 'https://your-website.com/cancel',
]);

echo '<script src="https://js.stripe.com/v3/"></script>
  <button id="checkout-button-sku_your_sku_id">Subscribe</button>
  <script>
    var stripe = Stripe("pk_test_your_stripe_publishable_key");
    var checkoutButton = document.getElementById("checkout-button-sku_your_sku_id");
    checkoutButton.addEventListener("click", function () {
      stripe.redirectToCheckout({
        sessionId: "' . $session->id . '"
      });
    });
  </script>';
?>
