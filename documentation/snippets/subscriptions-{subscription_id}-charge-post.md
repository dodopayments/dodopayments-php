```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\CreateSubscriptionChargeRequest;

$sdk = new Client(accessToken: 'YOUR_TOKEN');


$input = new Models\CreateSubscriptionChargeRequest(
  metadata: [],
  productPrice: 6
);

$response = $sdk->subscriptions->createSubscriptionCharge(
  input: $input,
  subscriptionId: "subscription_id"
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->