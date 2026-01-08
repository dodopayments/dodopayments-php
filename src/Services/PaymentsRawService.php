<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
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
use Dodopayments\ServiceContracts\PaymentsRawContract;

/**
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type OneTimeProductCartItemShape from \Dodopayments\Payments\OneTimeProductCartItem
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PaymentsRawService implements PaymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated
     *
     * @api
     *
     * @param array{
     *   billing: BillingAddress|BillingAddressShape,
     *   customer: CustomerRequestShape,
     *   productCart: list<OneTimeProductCartItem|OneTimeProductCartItemShape>,
     *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
     *   billingCurrency?: value-of<Currency>,
     *   discountCode?: string|null,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>,
     *   paymentLink?: bool|null,
     *   paymentMethodID?: string|null,
     *   redirectImmediately?: bool,
     *   returnURL?: string|null,
     *   shortLink?: bool|null,
     *   showSavedPaymentMethods?: bool,
     *   taxID?: string|null,
     * }|PaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaymentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Payment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @param array{
     *   brandID?: string,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: value-of<Status>,
     *   subscriptionID?: string,
     * }|PaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<PaymentListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'subscriptionID' => 'subscription_id',
                ],
            ),
            options: $options,
            convert: PaymentListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaymentGetLineItemsResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/%1$s/line-items', $paymentID],
            options: $requestOptions,
            convert: PaymentGetLineItemsResponse::class,
        );
    }
}
