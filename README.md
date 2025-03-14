# dodopayments PHP SDK 1.7.0


Welcome to the dodopayments SDK documentation. This guide will help you get started with integrating and using the dodopayments SDK in your project.

[![This SDK was generated by liblab](https://public-liblab-readme-assets.s3.us-east-1.amazonaws.com/built-by-liblab-icon.svg)](https://liblab.com/?utm_source=readme)

## Versions

- API version: `1.7.0`
- SDK version: `1.7.0`

## Table of Contents
- [Setup & Configuration](#setup--configuration)
	- [Supported Language Versions](#supported-language-versions)
	- [Installation](#installation)
- [Authentication](#authentication)
	- [Access Token Authentication](#access-token-authentication)
- [Environments](#environments)
	- [Setting an Environment](#setting-an-environment)
- [Setting a Custom Timeout](#setting-a-custom-timeout)
- [Sample Usage](#sample-usage)
- [Services](#services)
- [Models](#models)
- [License](#license)

## Setup & Configuration

### Supported Language Versions

This SDK is compatible with the following versions: `PHP >= 8.0`

### Installation

To get started with the SDK, we recommend installing using `composer`:

```bash
composer require dodopayments/client
```

## Authentication

### Access Token Authentication
The dodopayments API uses an Access Token for authentication.

This token must be provided to authenticate your requests to the API.

#### Setting the Access Token

When you initialize the SDK, you can set the access token as follows:

```php
new Client(accessToken: "YOUR_ACCESS_TOKEN");
```

If you need to set or update the access token after initializing the SDK, you can use:

```php
sdk.setAccessToken("YOUR_ACCESS_TOKEN")
```


## Environments

The SDK supports different environments for various stages of development and deployment.

Here are the available environments:

```php
const Default = "https://live.dodopayments.com"
const LiveMode = "https://live.dodopayments.com"
const TestMode = "https://test.dodopayments.com"
```

## Setting an Environment

To configure the SDK to use a specific environment, you can set the base URL as follows:

```php
$sdk->setBaseUrl(Environment::live_mode);
```



## Setting a Custom Timeout

You can set a custom timeout for the SDK's HTTP requests as follows:

```php
$sdk = new Client(timeout: 1000);
```

# Sample Usage

Below is a comprehensive example demonstrating how to authenticate and call a simple endpoint:

```php
<?php

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->addons->listAddons(
  pageSize: 8,
  pageNumber: 2
);

print_r($response);

```

## Services

The SDK provides various services to interact with the API.

<details> 
<summary>Below is a list of all available services with links to their detailed documentation:</summary>

| Name |
| :--- |
| [Addons](documentation/services/Addons.md) |
| [Checkout](documentation/services/Checkout.md) |
| [Customers](documentation/services/Customers.md) |
| [Discounts](documentation/services/Discounts.md) |
| [Disputes](documentation/services/Disputes.md) |
| [Invoices](documentation/services/Invoices.md) |
| [LicenseKeys](documentation/services/LicenseKeys.md) |
| [Licenses](documentation/services/Licenses.md) |
| [Payments](documentation/services/Payments.md) |
| [Payouts](documentation/services/Payouts.md) |
| [Products](documentation/services/Products.md) |
| [Refunds](documentation/services/Refunds.md) |
| [Subscriptions](documentation/services/Subscriptions.md) |
| [WebhookEvents](documentation/services/WebhookEvents.md) |
| [OutgoingWebhooks](documentation/services/OutgoingWebhooks.md) |
</details>

## Models

The SDK includes several models that represent the data structures used in API requests and responses. These models help in organizing and managing the data efficiently.

<details> 
<summary>Below is a list of all available models with links to their detailed documentation:</summary>

| Name       | Description |
| :--------- | :---------- |
| [AddonsListResponse](documentation/models/AddonsListResponse.md) |  |
| [CreateAddonRequest](documentation/models/CreateAddonRequest.md) |  |
| [AddonResponse](documentation/models/AddonResponse.md) |  |
| [PatchAddonRequest](documentation/models/PatchAddonRequest.md) |  |
| [UpdateAddonImageResponse](documentation/models/UpdateAddonImageResponse.md) |  |
| [CountryCodeAlpha2](documentation/models/CountryCodeAlpha2.md) | ISO country code alpha2 variant |
| [GetCustomersListResponse](documentation/models/GetCustomersListResponse.md) |  |
| [CreateCustomerRequest](documentation/models/CreateCustomerRequest.md) |  |
| [CustomerResponse](documentation/models/CustomerResponse.md) |  |
| [PatchCustomerRequest](documentation/models/PatchCustomerRequest.md) |  |
| [GetDiscountsListResponse](documentation/models/GetDiscountsListResponse.md) |  |
| [CreateDiscountRequest](documentation/models/CreateDiscountRequest.md) | Request body for creating a discount. `code` is optional; if not provided, we generate a random 16-char code. |
| [DiscountResponse](documentation/models/DiscountResponse.md) |  |
| [PatchDiscountRequest](documentation/models/PatchDiscountRequest.md) | Request body for patching (updating) a discount. All fields are optional and only update if provided. |
| [GetDisputesListResponse](documentation/models/GetDisputesListResponse.md) |  |
| [DisputeStatus](documentation/models/DisputeStatus.md) |  |
| [DisputeStage](documentation/models/DisputeStage.md) |  |
| [DisputeResponse](documentation/models/DisputeResponse.md) |  |
| [ListLicenseKeyInstancesResponse](documentation/models/ListLicenseKeyInstancesResponse.md) |  |
| [LicenseKeyInstanceResponse](documentation/models/LicenseKeyInstanceResponse.md) |  |
| [PatchLicenseKeyInstanceRequest](documentation/models/PatchLicenseKeyInstanceRequest.md) |  |
| [ListLicenseKeysResponse](documentation/models/ListLicenseKeysResponse.md) |  |
| [LicenseKeyStatus](documentation/models/LicenseKeyStatus.md) |  |
| [LicenseKeyResponse](documentation/models/LicenseKeyResponse.md) |  |
| [PatchLicenseKeyRequest](documentation/models/PatchLicenseKeyRequest.md) |  |
| [ActivateLicenseKeyRequest](documentation/models/ActivateLicenseKeyRequest.md) |  |
| [DeactivateLicenseKeyRequest](documentation/models/DeactivateLicenseKeyRequest.md) |  |
| [ValidateLicenseKeyRequest](documentation/models/ValidateLicenseKeyRequest.md) |  |
| [ValidateLicenseKeyResponse](documentation/models/ValidateLicenseKeyResponse.md) |  |
| [GetPaymentsListResponse](documentation/models/GetPaymentsListResponse.md) |  |
| [IntentStatus](documentation/models/IntentStatus.md) |  |
| [CreateOneTimePaymentRequest](documentation/models/CreateOneTimePaymentRequest.md) |  |
| [CreateOneTimePaymentResponse](documentation/models/CreateOneTimePaymentResponse.md) |  |
| [PaymentResponse](documentation/models/PaymentResponse.md) |  |
| [GetPayoutsResponseList](documentation/models/GetPayoutsResponseList.md) |  |
| [GetProductsListResponse](documentation/models/GetProductsListResponse.md) |  |
| [CreateProductRequest](documentation/models/CreateProductRequest.md) |  |
| [GetProductResponse](documentation/models/GetProductResponse.md) |  |
| [PatchProductRequest](documentation/models/PatchProductRequest.md) |  |
| [UpdateProductImageResponse](documentation/models/UpdateProductImageResponse.md) |  |
| [GetRefundsListResponse](documentation/models/GetRefundsListResponse.md) |  |
| [RefundStatus](documentation/models/RefundStatus.md) |  |
| [CreateRefundRequest](documentation/models/CreateRefundRequest.md) |  |
| [RefundResponse](documentation/models/RefundResponse.md) |  |
| [GetSubscriptionsListResponse](documentation/models/GetSubscriptionsListResponse.md) |  |
| [SubscriptionStatus](documentation/models/SubscriptionStatus.md) |  |
| [CreateSubscriptionRequest](documentation/models/CreateSubscriptionRequest.md) | Request payload for creating a new subscription This struct represents the data required to create a new subscription in the system. It includes details about the product, quantity, customer information, and billing details. |
| [CreateSubscriptionResponse](documentation/models/CreateSubscriptionResponse.md) |  |
| [SubscriptionResponse](documentation/models/SubscriptionResponse.md) | Response struct representing subscription details |
| [PatchSubscriptionRequest](documentation/models/PatchSubscriptionRequest.md) |  |
| [ListWebhookEventsResponse](documentation/models/ListWebhookEventsResponse.md) |  |
| [WebhookEventLogResponse](documentation/models/WebhookEventLogResponse.md) |  |
| [OutgoingWebhook](documentation/models/OutgoingWebhook.md) |  |
| [Currency](documentation/models/Currency.md) |  |
| [TaxCategory](documentation/models/TaxCategory.md) | Represents the different categories of taxation applicable to various products and services. |
| [DiscountType](documentation/models/DiscountType.md) |  |
| [GetPaymentsListResponseItem](documentation/models/GetPaymentsListResponseItem.md) |  |
| [CustomerLimitedDetailsResponse](documentation/models/CustomerLimitedDetailsResponse.md) |  |
| [BillingAddress](documentation/models/BillingAddress.md) |  |
| [CustomerRequest](documentation/models/CustomerRequest.md) |  |
| [OneTimeProductCartItemReq](documentation/models/OneTimeProductCartItemReq.md) |  |
| [AttachExistingCustomer](documentation/models/AttachExistingCustomer.md) |  |
| [CreateNewCustomer](documentation/models/CreateNewCustomer.md) |  |
| [OneTimeProductCartItemResponse](documentation/models/OneTimeProductCartItemResponse.md) |  |
| [PayoutsResponse](documentation/models/PayoutsResponse.md) |  |
| [PayoutStatus](documentation/models/PayoutStatus.md) |  |
| [GetProductsListResponseItem](documentation/models/GetProductsListResponseItem.md) |  |
| [Price](documentation/models/Price.md) |  |
| [Price_1](documentation/models/Price1.md) |  |
| [Price_2](documentation/models/Price2.md) |  |
| [Price_1Type](documentation/models/Price1Type.md) |  |
| [TimeInterval](documentation/models/TimeInterval.md) |  |
| [Price_2Type](documentation/models/Price2Type.md) |  |
| [LicenseKeyDuration](documentation/models/LicenseKeyDuration.md) |  |
| [OutgoingWebhookData](documentation/models/OutgoingWebhookData.md) |  |
| [EventType](documentation/models/EventType.md) | Event types for Dodo events |
| [OutgoingWebhookData_1](documentation/models/OutgoingWebhookData1.md) |  |
| [OutgoingWebhookData_2](documentation/models/OutgoingWebhookData2.md) |  |
| [OutgoingWebhookData_3](documentation/models/OutgoingWebhookData3.md) |  |
| [OutgoingWebhookData_4](documentation/models/OutgoingWebhookData4.md) |  |
| [OutgoingWebhookData_5](documentation/models/OutgoingWebhookData5.md) |  |
| [OutgoingWebhookData_1PayloadType](documentation/models/OutgoingWebhookData1PayloadType.md) |  |
| [OutgoingWebhookData_2PayloadType](documentation/models/OutgoingWebhookData2PayloadType.md) |  |
| [OutgoingWebhookData_3PayloadType](documentation/models/OutgoingWebhookData3PayloadType.md) |  |
| [OutgoingWebhookData_4PayloadType](documentation/models/OutgoingWebhookData4PayloadType.md) |  |
| [OutgoingWebhookData_5PayloadType](documentation/models/OutgoingWebhookData5PayloadType.md) |  |
</details>

## License

This SDK is licensed under the Apache-2.0 License.

See the [LICENSE](LICENSE) file for more details.




<!-- This file was generated by liblab | https://liblab.com/ -->