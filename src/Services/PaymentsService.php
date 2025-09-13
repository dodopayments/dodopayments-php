<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PaymentsContract;

use const Dodopayments\Core\OMIT as omit;

final class PaymentsService implements PaymentsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param BillingAddress $billing Billing address details for the payment
     * @param AttachExistingCustomer|NewCustomer $customer Customer information for the payment
     * @param list<OneTimeProductCartItem> $productCart List of products in the cart. Must contain at least 1 and at most 100 items.
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency|value-of<Currency>|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the transaction
     * @param array<string,
     * string,> $metadata Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     * @param bool|null $paymentLink Whether to generate a payment link. Defaults to false if not specified.
     * @param string|null $returnURL Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     *
     * @return PaymentNewResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $billing,
        $customer,
        $productCart,
        $allowedPaymentMethodTypes = omit,
        $billingCurrency = omit,
        $discountCode = omit,
        $metadata = omit,
        $paymentLink = omit,
        $returnURL = omit,
        $showSavedPaymentMethods = omit,
        $taxID = omit,
        ?RequestOptions $requestOptions = null,
    ): PaymentNewResponse {
        $params = [
            'billing' => $billing,
            'customer' => $customer,
            'productCart' => $productCart,
            'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
            'billingCurrency' => $billingCurrency,
            'discountCode' => $discountCode,
            'metadata' => $metadata,
            'paymentLink' => $paymentLink,
            'returnURL' => $returnURL,
            'showSavedPaymentMethods' => $showSavedPaymentMethods,
            'taxID' => $taxID,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PaymentNewResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): PaymentNewResponse {
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'payments',
            body: (object) $parsed,
            options: $options,
            convert: PaymentNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @return Payment<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment {
        $params = [];

        return $this->retrieveRaw($paymentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return Payment<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $paymentID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): Payment {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['payments/%1$s', $paymentID],
            options: $requestOptions,
            convert: Payment::class,
        );
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
     * @param Status|value-of<Status> $status Filter by status
     * @param string $subscriptionID Filter by subscription id
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function list(
        $brandID = omit,
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $status = omit,
        $subscriptionID = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'brandID' => $brandID,
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'customerID' => $customerID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'status' => $status,
            'subscriptionID' => $subscriptionID,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = PaymentListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'payments',
            query: $parsed,
            options: $options,
            convert: PaymentListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @return PaymentGetLineItemsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse {
        $params = [];

        return $this->retrieveLineItemsRaw($paymentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return PaymentGetLineItemsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItemsRaw(
        string $paymentID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['payments/%1$s/line-items', $paymentID],
            options: $requestOptions,
            convert: PaymentGetLineItemsResponse::class,
        );
    }
}
