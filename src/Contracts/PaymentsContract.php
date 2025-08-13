<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

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
