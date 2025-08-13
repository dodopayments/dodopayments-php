<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Responses\Subscriptions\SubscriptionListResponse;
use Dodopayments\Responses\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionCreateParams\OnDemand;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

interface SubscriptionsContract
{
    /**
     * @param array{
     *   billing: BillingAddress,
     *   customer: AttachExistingCustomer|NewCustomer,
     *   productID: string,
     *   quantity: int,
     *   addons?: null|list<AttachAddon>,
     *   allowedPaymentMethodTypes?: null|list<PaymentMethodTypes::*>,
     *   billingCurrency?: Currency::*,
     *   discountCode?: null|string,
     *   metadata?: array<string, string>,
     *   onDemand?: null|OnDemand,
     *   paymentLink?: null|bool,
     *   returnURL?: null|string,
     *   showSavedPaymentMethods?: bool,
     *   taxID?: null|string,
     *   trialPeriodDays?: null|int,
     * }|SubscriptionCreateParams $params
     */
    public function create(
        array|SubscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse;

    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription;

    /**
     * @param array{
     *   billing?: BillingAddress,
     *   cancelAtNextBillingDate?: null|bool,
     *   disableOnDemand?: null|DisableOnDemand,
     *   metadata?: null|array<string, string>,
     *   nextBillingDate?: null|\DateTimeInterface,
     *   status?: SubscriptionStatus::*,
     *   taxID?: null|string,
     * }|SubscriptionUpdateParams $params
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Subscription;

    /**
     * @param array{
     *   brandID?: string,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status::*,
     * }|SubscriptionListParams $params
     */
    public function list(
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionListResponse;

    /**
     * @param array{
     *   productID: string,
     *   prorationBillingMode: ProrationBillingMode::*,
     *   quantity: int,
     *   addons?: null|list<AttachAddon>,
     * }|SubscriptionChangePlanParams $params
     */
    public function changePlan(
        string $subscriptionID,
        array|SubscriptionChangePlanParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param array{
     *   productPrice: int,
     *   adaptiveCurrencyFeesInclusive?: null|bool,
     *   metadata?: null|array<string, string>,
     *   productCurrency?: Currency::*,
     *   productDescription?: null|string,
     * }|SubscriptionChargeParams $params
     */
    public function charge(
        string $subscriptionID,
        array|SubscriptionChargeParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse;
}
