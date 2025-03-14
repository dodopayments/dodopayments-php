# OutgoingWebhookData




# OutgoingWebhookData_1



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | businessId | string | ✅ | Identifier of the business associated with the payment |
    | createdAt | string | ✅ | Timestamp when the payment was created |
    | currency | model | ✅ |  |
    | customer | model | ✅ |  |
    | disputes | array | ✅ | List of disputes associated with this payment |
    | metadata | dictionary | ✅ |  |
    | paymentId | string | ✅ | Unique identifier for the payment |
    | refunds | array | ✅ | List of refunds issued for this payment |
    | totalAmount | integer | ✅ | Total amount charged to the customer including tax, in smallest currency unit (e.g. cents) |
    | payloadType | model | ✅ |  |
    | discountId | string | ❌ | The discount id if discount is applied |
    | errorMessage | string | ❌ | An error message if the payment failed |
    | paymentLink | string | ❌ | Checkout URL |
    | paymentMethod | string | ❌ | Payment method used by customer (e.g. "card", "bank_transfer") |
    | paymentMethodType | string | ❌ | Specific type of payment method (e.g. "visa", "mastercard") |
    | productCart | array | ❌ | List of products purchased in a one-time payment |
    | status | model | ❌ |  |
    | subscriptionId | string | ❌ | Identifier of the subscription if payment is part of a subscription |
    | tax | integer | ❌ | Amount of tax collected in smallest currency unit (e.g. cents) |
    | updatedAt | string | ❌ | Timestamp when the payment was last updated |

# OutgoingWebhookData_1PayloadType



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | Payment | string |  | Payment |



# OutgoingWebhookData_2



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | createdAt | string | ✅ | Timestamp when the subscription was created |
    | currency | model | ✅ |  |
    | customer | model | ✅ |  |
    | metadata | dictionary | ✅ |  |
    | nextBillingDate | string | ✅ | Timestamp of the next scheduled billing |
    | paymentFrequencyCount | integer | ✅ | Number of payment frequency intervals |
    | paymentFrequencyInterval | model | ✅ |  |
    | productId | string | ✅ | Identifier of the product associated with this subscription |
    | quantity | integer | ✅ | Number of units/items included in the subscription |
    | recurringPreTaxAmount | integer | ✅ | Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents) |
    | status | model | ✅ |  |
    | subscriptionId | string | ✅ | Unique identifier for the subscription |
    | subscriptionPeriodCount | integer | ✅ | Number of subscription period intervals |
    | subscriptionPeriodInterval | model | ✅ |  |
    | taxInclusive | boolean | ✅ | Indicates if the recurring_pre_tax_amount is tax inclusive |
    | trialPeriodDays | integer | ✅ | Number of days in the trial period (0 if no trial) |
    | payloadType | model | ✅ |  |
    | cancelledAt | string | ❌ | Cancelled timestamp if the subscription is cancelled |
    | discountId | string | ❌ | The discount id if discount is applied |

# OutgoingWebhookData_2PayloadType



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | Subscription | string |  | Subscription |



# OutgoingWebhookData_3



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | businessId | string | ✅ | The unique identifier of the business issuing the refund. |
    | createdAt | string | ✅ | The timestamp of when the refund was created in UTC. |
    | paymentId | string | ✅ | The unique identifier of the payment associated with the refund. |
    | refundId | string | ✅ | The unique identifier of the refund. |
    | status | model | ✅ |  |
    | payloadType | model | ✅ |  |
    | amount | integer | ❌ | The refunded amount. |
    | currency | model | ❌ |  |
    | reason | string | ❌ | The reason provided for the refund, if any. Optional. |

# OutgoingWebhookData_3PayloadType



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | Refund | string |  | Refund |



# OutgoingWebhookData_4



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | amount | string | ✅ | The amount involved in the dispute, represented as a string to accommodate precision. |
    | businessId | string | ✅ | The unique identifier of the business involved in the dispute. |
    | createdAt | string | ✅ | The timestamp of when the dispute was created, in UTC. |
    | currency | string | ✅ | The currency of the disputed amount, represented as an ISO 4217 currency code. |
    | disputeId | string | ✅ | The unique identifier of the dispute. |
    | disputeStage | model | ✅ |  |
    | disputeStatus | model | ✅ |  |
    | paymentId | string | ✅ | The unique identifier of the payment associated with the dispute. |
    | payloadType | model | ✅ |  |

# OutgoingWebhookData_4PayloadType



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | Dispute | string |  | Dispute |



# OutgoingWebhookData_5



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | businessId | string | ✅ | The unique identifier of the business associated with the license key. |
    | createdAt | string | ✅ | The timestamp indicating when the license key was created, in UTC. |
    | customerId | string | ✅ | The unique identifier of the customer associated with the license key. |
    | id | string | ✅ | The unique identifier of the license key. |
    | instancesCount | integer | ✅ | The current number of instances activated for this license key. |
    | key | string | ✅ | The license key string. |
    | paymentId | string | ✅ | The unique identifier of the payment associated with the license key. |
    | productId | string | ✅ | The unique identifier of the product associated with the license key. |
    | status | model | ✅ |  |
    | payloadType | model | ✅ |  |
    | activationsLimit | integer | ❌ | The maximum number of activations allowed for this license key. |
    | expiresAt | string | ❌ | The timestamp indicating when the license key expires, in UTC. |
    | subscriptionId | string | ❌ | The unique identifier of the subscription associated with the license key, if any. |

# OutgoingWebhookData_5PayloadType



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | LicenseKey | string |  | LicenseKey |






<!-- This file was generated by liblab | https://liblab.com/ -->