<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\AttachExistingCustomer;
use DodopaymentsClient\Payments\BillingAddress;
use DodopaymentsClient\Payments\NewCustomer;
use DodopaymentsClient\Payments\OneTimeProductCartItem;
use DodopaymentsClient\Payments\Payment;
use DodopaymentsClient\Payments\PaymentCreateParams;
use DodopaymentsClient\Payments\PaymentListParams;
use DodopaymentsClient\Payments\PaymentListParams\Status;
use DodopaymentsClient\Payments\PaymentMethodTypes;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Payments\PaymentGetLineItemsResponse;
use DodopaymentsClient\Responses\Payments\PaymentListResponse;
use DodopaymentsClient\Responses\Payments\PaymentNewResponse;

interface PaymentsContract
{
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
        ?RequestOptions $requestOptions = null,
    ): PaymentNewResponse;

    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment;

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
    ): PaymentListResponse;

    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse;
}
