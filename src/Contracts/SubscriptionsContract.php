<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Misc\Currency;
use DodoPayments\Payments\AttachExistingCustomer;
use DodoPayments\Payments\BillingAddress;
use DodoPayments\Payments\NewCustomer;
use DodoPayments\Payments\PaymentMethodTypes;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Subscriptions\SubscriptionChargeResponse;
use DodoPayments\Responses\Subscriptions\SubscriptionListResponse;
use DodoPayments\Responses\Subscriptions\SubscriptionNewResponse;
use DodoPayments\Subscriptions\AttachAddon;
use DodoPayments\Subscriptions\Subscription;
use DodoPayments\Subscriptions\SubscriptionChangePlanParams;
use DodoPayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use DodoPayments\Subscriptions\SubscriptionChargeParams;
use DodoPayments\Subscriptions\SubscriptionCreateParams;
use DodoPayments\Subscriptions\SubscriptionCreateParams\OnDemand;
use DodoPayments\Subscriptions\SubscriptionListParams;
use DodoPayments\Subscriptions\SubscriptionListParams\Status;
use DodoPayments\Subscriptions\SubscriptionStatus;
use DodoPayments\Subscriptions\SubscriptionUpdateParams;
use DodoPayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

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
