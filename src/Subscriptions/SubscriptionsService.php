<?php

declare(strict_types=1);

namespace DodopaymentsClient\Subscriptions;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\SubscriptionsContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\AttachExistingCustomer;
use DodopaymentsClient\Payments\BillingAddress;
use DodopaymentsClient\Payments\NewCustomer;
use DodopaymentsClient\Payments\PaymentMethodTypes;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionChargeResponse;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionListResponse;
use DodopaymentsClient\Responses\Subscriptions\SubscriptionNewResponse;
use DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams\OnDemand;
use DodopaymentsClient\Subscriptions\SubscriptionListParams\Status;
use DodopaymentsClient\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

final class SubscriptionsService implements SubscriptionsContract
{
    public function __construct(private Client $client) {}

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
    ): SubscriptionNewResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'subscriptions',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(SubscriptionNewResponse::class, value: $resp);
    }

    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription {
        $resp = $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s', $subscriptionID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Subscription::class, value: $resp);
    }

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
    ): Subscription {
        [$parsed, $options] = SubscriptionUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['subscriptions/%1$s', $subscriptionID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Subscription::class, value: $resp);
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
     * }|SubscriptionListParams $params
     */
    public function list(
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null
    ): SubscriptionListResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'subscriptions',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(SubscriptionListResponse::class, value: $resp);
    }

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
    ): mixed {
        [$parsed, $options] = SubscriptionChangePlanParams::parseRequest(
            $params,
            $requestOptions
        );

        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/change-plan', $subscriptionID],
            body: (object) $parsed,
            options: $options,
        );
    }

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
    ): SubscriptionChargeResponse {
        [$parsed, $options] = SubscriptionChargeParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/charge', $subscriptionID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(SubscriptionChargeResponse::class, value: $resp);
    }
}
