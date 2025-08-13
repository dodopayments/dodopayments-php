<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Misc\Currency;
use DodoPayments\Payments\AttachExistingCustomer;
use DodoPayments\Payments\BillingAddress;
use DodoPayments\Payments\NewCustomer;
use DodoPayments\Payments\OneTimeProductCartItem;
use DodoPayments\Payments\Payment;
use DodoPayments\Payments\PaymentCreateParams;
use DodoPayments\Payments\PaymentListParams;
use DodoPayments\Payments\PaymentListParams\Status;
use DodoPayments\Payments\PaymentMethodTypes;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Payments\PaymentGetLineItemsResponse;
use DodoPayments\Responses\Payments\PaymentListResponse;
use DodoPayments\Responses\Payments\PaymentNewResponse;

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
