# OutgoingWebhooks

A list of all methods in the `OutgoingWebhooks` service. Click on the method name to view detailed information about that method.

| Methods | Description |
| :------ | :---------- |
|[dummy_handler_for_outgoing_webhook_docs](#dummy_handler_for_outgoing_webhook_docs)|  |

## dummy_handler_for_outgoing_webhook_docs


- HTTP Method: `POST`
- Endpoint: `/your-webhook-url`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| input | Models\OutgoingWebhook | ✅ |  |
| $webhookId | string | ✅ | Unique identifier for the webhook |
| $webhookSignature | string | ✅ | Signature of the Webhook |
| $webhookTimestamp | string | ✅ | Unix timestamp when the webhook was sent |

**Return Type**

`mixed`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\OutgoingWebhookData;
use Dodopayments\Models\EventType;
use Dodopayments\Models\OutgoingWebhook;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

COMPLEX_MODEL_NOT_IMPLEMENTED

$eventType = Models\EventType::PaymentSucceeded;

$input = new Models\OutgoingWebhook(
  businessId: "business_id",
  data: $outgoingWebhookData,
  timestamp: "timestamp",
  type: $eventType
);

$response = $sdk->outgoingWebhooks->dummyHandlerForOutgoingWebhookDocs(
  input: $input,
  webhookId: "webhook-id",
  webhookSignature: "webhook-signature",
  webhookTimestamp: "webhook-timestamp"
);

print_r($response);
```




<!-- This file was generated by liblab | https://liblab.com/ -->