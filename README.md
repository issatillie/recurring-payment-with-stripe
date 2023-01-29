# recurring-payment-with-stripe

Functionality was built into this Stripe recurring payment. After a successful transaction, it automatically changes the customer's information.

# installation

1. To install it, either download the ```stripe-php``` folder or use your composer.
2. Register with Stripe. Configure Stripe in testmodus. Take note of the secret and publishable key.
3. Create a plan on Stripe and copy the ID.
4. Go to ```stripe-payment.php``` and copy the following ID in the ```your_plan_id``` field.
5. Test it out.
6. Adjust it to your preferences, and you're ready to go! I hope this code was useful to you.

# stripe-payment.php

The user can enter their credit card information in a popup that is displayed as a result of this code.

# stripe-payment-advanced-bank.php

The user can enter their credit card information or transfer money to a bank account in a popup that is displayed as a result of this code.

# stripe-payment-advanced-ideal.php

The user can either enter their credit card information or use iDeal in a popup that is displayed as a result of this code. Note that this only works when the currency is set to euro's (€).
