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
composer require "dodopayments/client 0.0.1"
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use Dodopayments\Client;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;

$client = new Client(
  bearerToken: getenv("DODO_PAYMENTS_API_KEY") ?: "My Bearer Token",
  environment: "test_mode",
);

$checkoutSessionResponse = $client->checkoutSessions->create(
  productCart: [ProductCart::with(productID: "product_id", quantity: 0)]
);

var_dump($checkoutSessionResponse->session_id);
```

### Value Objects

It is recommended to use the static `with` constructor `AttachExistingCustomer::with(customerID: "customer_id", ...)`
and named parameters to initialize value objects.

However, builders are also provided `(new AttachExistingCustomer)->withCustomerID("customer_id")`.

### Pagination

List methods in the Dodo Payments API are paginated.

This library provides auto-paginating iterators with each list response, so you do not have to request successive pages manually:

```php
<?php

use Dodopayments\Client;

$client = new Client(
  bearerToken: getenv("DODO_PAYMENTS_API_KEY") ?: "My Bearer Token",
  environment: "test_mode",
);

$page = $client->payments->list();

var_dump($page);

// fetch items from the current page
foreach ($page->getItems() as $item) {
  var_dump($item->brand_id);
}
// make additional network requests to fetch items from all pages, including and after the current page
foreach ($page->pagingEachItem() as $item) {
  var_dump($item->brand_id);
}
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `Dodopayments\Core\Exceptions\APIException` will be thrown:

```php
<?php

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;
use Dodopayments\Core\Exceptions\APIConnectionException;

try {
  $checkoutSessionResponse = $client->checkoutSessions->create(
    productCart: [ProductCart::with(productID: "product_id", quantity: 0)]
  );
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitError $_) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusError $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `max_retries` option to configure or disable this:

```php
<?php

use Dodopayments\Client;
use Dodopayments\RequestOptions;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;

// Configure the default for all requests:
$client = new Client(maxRetries: 0);

// Or, configure per-request:

$result = $client->checkoutSessions->create(
  productCart: [ProductCart::with(productID: "product_id", quantity: 0)],
  new RequestOptions(maxRetries: 5),
);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra_` parameters of the same name overrides the documented parameters.

```php
<?php

use Dodopayments\RequestOptions;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;

$checkoutSessionResponse = $client->checkoutSessions->create(
  productCart: [ProductCart::with(productID: "product_id", quantity: 0)],
  new RequestOptions(
    extraQueryParams: ["my_query_parameter" => "value"],
    extraBodyParams: ["my_body_parameter" => "value"],
    extraHeaders: ["my-header" => "value"],
  ),
);

var_dump($checkoutSessionResponse["my_undocumented_property"]);
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
