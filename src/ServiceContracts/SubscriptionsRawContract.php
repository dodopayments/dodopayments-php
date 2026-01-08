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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Subscription>
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Subscription>
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<SubscriptionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionChangePlanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        array|SubscriptionChangePlanParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionChargeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionChargeResponse>
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        array|SubscriptionChargeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionPreviewChangePlanParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionPreviewChangePlanResponse>
     *
     * @throws APIException
     */
    public function previewChangePlan(
        string $subscriptionID,
        array|SubscriptionPreviewChangePlanParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Unique subscription identifier
     * @param array<string,mixed>|SubscriptionRetrieveUsageHistoryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse,>,>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        array|SubscriptionRetrieveUsageHistoryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array<string,mixed>|SubscriptionUpdatePaymentMethodParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionUpdatePaymentMethodResponse>
     *
     * @throws APIException
     */
    public function updatePaymentMethod(
        string $subscriptionID,
        array|SubscriptionUpdatePaymentMethodParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
