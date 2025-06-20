# Refunds

A list of all methods in the `Refunds` service. Click on the method name to view detailed information about that method.

| Methods | Description |
| :------ | :---------- |
|[list_refunds](#list_refunds)|  |
|[create_refund_handler](#create_refund_handler)|  |
|[get_refund_handler](#get_refund_handler)|  |

## list_refunds


- HTTP Method: `GET`
- Endpoint: `/refunds`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| $createdAtGte | string | ❌ | Get events after this created time |
| $createdAtLte | string | ❌ | Get events created before this time |
| $pageSize | int | ❌ | Page size default is 10 max is 100 |
| $pageNumber | int | ❌ | Page number default is 0 |
| $status | Models\RefundStatus | ❌ | Filter by status |
| $customerId | string | ❌ | Filter by customer_id |

**Return Type**

`Models\GetRefundsListResponse`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$status = Models\RefundStatus::Succeeded;

$response = $sdk->refunds->listRefunds(
  createdAtGte: "created_at_gte",
  createdAtLte: "created_at_lte",
  pageSize: 8,
  pageNumber: 9,
  status: $status,
  customerId: "customer_id"
);

print_r($response);
```

## create_refund_handler


- HTTP Method: `POST`
- Endpoint: `/refunds`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| input | Models\CreateRefundRequest | ✅ |  |

**Return Type**

`Models\RefundResponse`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\PartialRefundItem;
use Dodopayments\Models\CreateRefundRequest;

$sdk = new Client(accessToken: 'YOUR_TOKEN');


$input = new Models\CreateRefundRequest(
  items: [],
  paymentId: "payment_id",
  reason: "reason"
);

$response = $sdk->refunds->createRefundHandler(
  input: $input
);

print_r($response);
```

## get_refund_handler


- HTTP Method: `GET`
- Endpoint: `/refunds/{refund_id}`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| $refundId | string | ✅ | Refund Id |

**Return Type**

`Models\RefundResponse`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->refunds->getRefundHandler(
  refundId: "refund_id"
);

print_r($response);
```




<!-- This file was generated by liblab | https://liblab.com/ -->