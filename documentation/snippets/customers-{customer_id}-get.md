```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->customers->getCustomerHandler(
  customerId: "customer_id"
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->