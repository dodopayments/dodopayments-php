```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$disputeStatus = Models\DisputeStatus::DisputeOpened;
$disputeStage = Models\DisputeStage::PreDispute;

$response = $sdk->disputes->listDisputes(
  createdAtGte: "created_at_gte",
  createdAtLte: "created_at_lte",
  pageSize: 9,
  pageNumber: 9,
  disputeStatus: $disputeStatus,
  disputeStage: $disputeStage,
  customerId: "customer_id"
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->