<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\AttachExistingCustomer;
use DodopaymentsClient\Payments\BillingAddress;
use DodopaymentsClient\Payments\NewCustomer;
use DodopaymentsClient\Payments\PaymentMethodTypes;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionChargeResponse;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionListResponse;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionNewResponse;
use DodopaymentsClient\Subscriptions\AttachAddon;
use DodopaymentsClient\Subscriptions\Subscription;
use DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams;
use DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use DodopaymentsClient\Subscriptions\SubscriptionChargeParams;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams\OnDemand;
use DodopaymentsClient\Subscriptions\SubscriptionListParams;
use DodopaymentsClient\Subscriptions\SubscriptionListParams\Status;
use DodopaymentsClient\Subscriptions\SubscriptionStatus;
use DodopaymentsClient\Subscriptions\SubscriptionUpdateParams;
use DodopaymentsClient\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

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
