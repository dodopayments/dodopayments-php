```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$status = Models\SubscriptionStatus::Pending;

$response = $sdk->subscriptions->listSubscriptionsHandler(
  createdAtGte: "created_at_gte",
  createdAtLte: "created_at_lte",
  pageSize: 1,
  pageNumber: 8,
  customerId: "customer_id",
  status: $status,
  brandId: "brand_id"
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->