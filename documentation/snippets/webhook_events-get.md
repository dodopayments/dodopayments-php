```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->webhookEvents->listWebhookEvents(
  createdAtGte: "created_at_gte",
  createdAtLte: "created_at_lte",
  limit: 3,
  objectId: "object_id",
  pageSize: 10,
  pageNumber: 8,
  webhookId: "webhook_id"
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->