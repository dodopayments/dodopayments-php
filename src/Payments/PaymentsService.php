<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Client;
use Dodopayments\Contracts\PaymentsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Responses\Payments\PaymentListResponse;
use Dodopayments\Responses\Payments\PaymentNewResponse;

final class PaymentsService implements PaymentsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{
     *   billing: BillingAddress,
     *   customer: AttachExistingCustomer|NewCustomer,
     *   productCart: list<OneTimeProductCartItem>,
     *   allowedPaymentMethodTypes?: null|list<PaymentMethodTypes::*>,
     *   billingCurrency?: Currency::*,
     *   discountCode?: null|string,
     *   metadata?: array<string, string>,
     *   paymentLink?: null|bool,
     *   returnURL?: null|string,
     *   showSavedPaymentMethods?: bool,
     *   taxID?: null|string,
     * }|PaymentCreateParams $params
     */
    public function create(
        array|PaymentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): PaymentNewResponse {
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $params,
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
     * @param array{
     *   brandID?: string,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status::*,
     *   subscriptionID?: string,
     * }|PaymentListParams $params
     */
    public function list(
        array|PaymentListParams $params,
        ?RequestOptions $requestOptions = null
    ): PaymentListResponse {
        [$parsed, $options] = PaymentListParams::parseRequest(
            $params,
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
