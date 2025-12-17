<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
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
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;
use Dodopayments\Subscriptions\SubscriptionRetrieveUsageHistoryParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;

interface SubscriptionsRawContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|SubscriptionCreateParams $params
     *
     * @return BaseResponse<SubscriptionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     *
     * @return BaseResponse<Subscription>
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionUpdateParams $params
     *
     * @return BaseResponse<Subscription>
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<SubscriptionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionChangePlanParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        array|SubscriptionChangePlanParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionChargeParams $params
     *
     * @return BaseResponse<SubscriptionChargeResponse>
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        array|SubscriptionChargeParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionPreviewChangePlanParams $params
     *
     * @return BaseResponse<SubscriptionPreviewChangePlanResponse>
     *
     * @throws APIException
     */
    public function previewChangePlan(
        string $subscriptionID,
        array|SubscriptionPreviewChangePlanParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Unique subscription identifier
     * @param array<string,mixed>|SubscriptionRetrieveUsageHistoryParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse,>,>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        array|SubscriptionRetrieveUsageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionUpdatePaymentMethodParams $params
     *
     * @return BaseResponse<SubscriptionUpdatePaymentMethodResponse>
     *
     * @throws APIException
     */
    public function updatePaymentMethod(
        string $subscriptionID,
        array|SubscriptionUpdatePaymentMethodParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
