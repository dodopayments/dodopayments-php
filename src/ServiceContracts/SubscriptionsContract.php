<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionRetrieveUsageHistoryParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;

interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param array<mixed>|SubscriptionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Subscription;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionListParams $params
     *
     * @return DefaultPageNumberPagination<SubscriptionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionChangePlanParams $params
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        array|SubscriptionChangePlanParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionChargeParams $params
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        array|SubscriptionChargeParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionRetrieveUsageHistoryParams $params
     *
     * @return DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        array|SubscriptionRetrieveUsageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
