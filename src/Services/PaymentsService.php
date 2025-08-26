<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\PaymentsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\PaymentListParams;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Responses\Payments\PaymentListResponse;
use Dodopayments\Responses\Payments\PaymentNewResponse;

use const Dodopayments\Core\OMIT as omit;

final class PaymentsService implements PaymentsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param BillingAddress $billing Billing address details for the payment
     * @param AttachExistingCustomer|NewCustomer $customer Customer information for the payment
     * @param list<OneTimeProductCartItem> $productCart List of products in the cart. Must contain at least 1 and at most 100 items.
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency::* $billingCurrency Fix the currency in which the end customer is billed.
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
        $args = Util::array_filter_omit(
            [
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
            ],
        );
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'payments',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(PaymentNewResponse::class, value: $resp);
    }

    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment {
        $resp = $this->client->request(
            method: 'get',
            path: ['payments/%1$s', $paymentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Payment::class, value: $resp);
    }

    /**
     * @param string $brandID filter by Brand id
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status::* $status Filter by status
     * @param string $subscriptionID Filter by subscription id
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
    ): PaymentListResponse {
        $args = Util::array_filter_omit(
            [
                'brandID' => $brandID,
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
                'subscriptionID' => $subscriptionID,
            ],
        );
        [$parsed, $options] = PaymentListParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'payments',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(PaymentListResponse::class, value: $resp);
    }

    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['payments/%1$s/line-items', $paymentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(PaymentGetLineItemsResponse::class, value: $resp);
    }
}
