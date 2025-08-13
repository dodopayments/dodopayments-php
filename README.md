# Dodo Payments PHP API library

> [!NOTE]
> The Dodo Payments PHP API Library is currently in **beta** and we're excited for you to experiment with it!
>
> This library has not yet been exhaustively tested in production environments and may be missing some features you'd expect in a stable release. As we continue development, there may be breaking changes that require updates to your code.
>
> **We'd love your feedback!** Please share any suggestions, bug reports, feature requests, or general thoughts by [filing an issue](https://www.github.com/dodopayments/dodopayments-php/issues/new).

The Dodo Payments PHP library provides convenient access to the Dodo Payments REST API from any PHP 8.1.0+ application.

It is generated with [Stainless](https://www.stainless.com/).

## Documentation

The REST API documentation can be found on [docs.dodopayments.com](https://docs.dodopayments.com).

## Installation

<!-- x-release-please-start-version -->

```
composer require "dodopayments/client 1.47.1"
```

<!-- x-release-please-end -->

## Usage

```php
<?php

use Dodopayments\Client;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;

$client = new Client(
  bearerToken: getenv("DODO_PAYMENTS_API_KEY") ?: "My Bearer Token",
  environment: "test_mode",
);

$params = PaymentCreateParams::from(
  billing: BillingAddress::from(
    city: "city",
    country: CountryCode::AF,
    state: "state",
    street: "street",
    zipcode: "zipcode",
  ),
  customer: AttachExistingCustomer::from(customerID: "customer_id"),
  productCart: [
    OneTimeProductCartItem::from(productID: "product_id", quantity: 0)
  ],
);
$payment = $client->payments->create($params);

var_dump($payment->payment_id);
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `Dodopayments\Errors\APIError` will be thrown:

```php
<?php

use Dodopayments\Errors\APIConnectionError;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;

try {
    $params = PaymentCreateParams::from(
      billing: BillingAddress::from(
        city: "city",
        country: CountryCode::AF,
        state: "state",
        street: "street",
        zipcode: "zipcode",
      ),
      customer: AttachExistingCustomer::from(customerID: "customer_id"),
      productCart: [
        OneTimeProductCartItem::from(productID: "product_id", quantity: 0)
      ],
    );
    $Payments = $client->payments->create($params);
} catch (APIConnectionError $e) {
    echo "The server could not be reached", PHP_EOL;
    var_dump($e->getPrevious());
} catch (RateLimitError $_) {
    echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusError $e) {
    echo "Another non-200-range status code was received", PHP_EOL;
    var_dump($e->status);
}
```

Error codes are as follows:

| Cause            | Error Type                 |
| ---------------- | -------------------------- |
| HTTP 400         | `BadRequestError`          |
| HTTP 401         | `AuthenticationError`      |
| HTTP 403         | `PermissionDeniedError`    |
| HTTP 404         | `NotFoundError`            |
| HTTP 409         | `ConflictError`            |
| HTTP 422         | `UnprocessableEntityError` |
| HTTP 429         | `RateLimitError`           |
| HTTP >= 500      | `InternalServerError`      |
| Other HTTP error | `APIStatusError`           |
| Timeout          | `APITimeoutError`          |
| Network error    | `APIConnectionError`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `max_retries` option to configure or disable this:

```php
<?php

use Dodopayments\Client;
use Dodopayments\RequestOptions;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;

// Configure the default for all requests:
$client = new Client(maxRetries: 0);
$params = PaymentCreateParams::from(
  billing: BillingAddress::from(
    city: "city",
    country: CountryCode::AF,
    state: "state",
    street: "street",
    zipcode: "zipcode",
  ),
  customer: AttachExistingCustomer::from(customerID: "customer_id"),
  productCart: [
    OneTimeProductCartItem::from(productID: "product_id", quantity: 0)
  ],
);

// Or, configure per-request:
$result = $client->payments->create($params, new RequestOptions(maxRetries: 5));
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra_` parameters of the same name overrides the documented parameters.

```php
<?php

use Dodopayments\RequestOptions;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;

$params = PaymentCreateParams::from(
  billing: BillingAddress::from(
    city: "city",
    country: CountryCode::AF,
    state: "state",
    street: "street",
    zipcode: "zipcode",
  ),
  customer: AttachExistingCustomer::from(customerID: "customer_id"),
  productCart: [
    OneTimeProductCartItem::from(productID: "product_id", quantity: 0)
  ],
);
$payment = $client
  ->payments
  ->create(
  $params,
  new RequestOptions(
    extraQueryParams: ["my_query_parameter" => "value"],
    extraBodyParams: ["my_body_parameter" => "value"],
    extraHeaders: ["my-header" => "value"],
  ),
);

var_dump($payment["my_undocumented_property"]);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/dodopayments/dodopayments-php/tree/main/CONTRIBUTING.md).
