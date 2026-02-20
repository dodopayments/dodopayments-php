<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PaymentsContract;

/**
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type OneTimeProductCartItemShape from \Dodopayments\Payments\OneTimeProductCartItem
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PaymentsService implements PaymentsContract
{
    /**
     * @api
     */
    public PaymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PaymentsRawService($client);
    }

    /**
     * @deprecated
     *
     * @api
     *
     * @param BillingAddress|BillingAddressShape $billing Billing address details for the payment
     * @param CustomerRequestShape $customer Customer information for the payment
     * @param list<OneTimeProductCartItem|OneTimeProductCartItemShape> $productCart List of products in the cart. Must contain at least 1 and at most 100 items.
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency|value-of<Currency>|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the transaction
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this payment
     * @param array<string,string> $metadata Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     * @param bool|null $paymentLink Whether to generate a payment link. Defaults to false if not specified.
     * @param string|null $paymentMethodID Optional payment method ID to use for this payment.
     * If provided, customer_id must also be provided.
     * The payment method will be validated for eligibility with the payment's currency.
     * @param bool $redirectImmediately If true, redirects the customer immediately after payment completion
     * False by default
     * @param string|null $returnURL Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     * @param bool|null $shortLink If true, returns a shortened payment link.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        BillingAddress|array $billing,
        AttachExistingCustomer|array|NewCustomer $customer,
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        Currency|string|null $billingCurrency = null,
        ?string $discountCode = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $paymentLink = null,
        ?string $paymentMethodID = null,
        ?bool $redirectImmediately = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaymentNewResponse {
        $params = Util::removeNulls(
            [
                'billing' => $billing,
                'customer' => $customer,
                'productCart' => $productCart,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingCurrency' => $billingCurrency,
                'discountCode' => $discountCode,
                'force3DS' => $force3DS,
                'metadata' => $metadata,
                'paymentLink' => $paymentLink,
                'paymentMethodID' => $paymentMethodID,
                'redirectImmediately' => $redirectImmediately,
                'returnURL' => $returnURL,
                'shortLink' => $shortLink,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'taxID' => $taxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): Payment {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($paymentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $brandID filter by Brand id
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product id
     * @param Status|value-of<Status> $status Filter by status
     * @param string $subscriptionID Filter by subscription id
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?string $brandID = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        Status|string|null $status = null,
        ?string $subscriptionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'brandID' => $brandID,
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'productID' => $productID,
                'status' => $status,
                'subscriptionID' => $subscriptionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): PaymentGetLineItemsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveLineItems($paymentID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
