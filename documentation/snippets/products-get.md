```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->products->listProducts(
  pageSize: 5,
  pageNumber: 8,
  archived: true
);

print_r($response);

```


<!-- This file was generated by liblab | https://liblab.com/ -->