<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\SubscriptionsRawContract;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\OnDemandSubscription;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionChargeParams\CustomerBalanceConfig;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;
use Dodopayments\Subscriptions\SubscriptionRetrieveUsageHistoryParams;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\Type;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;

/**
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type OnDemandSubscriptionShape from \Dodopayments\Subscriptions\OnDemandSubscription
 * @phpstan-import-type OneTimeProductCartItemShape from \Dodopayments\Payments\OneTimeProductCartItem
 * @phpstan-import-type DisableOnDemandShape from \Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand
 * @phpstan-import-type CustomerBalanceConfigShape from \Dodopayments\Subscriptions\SubscriptionChargeParams\CustomerBalanceConfig
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class SubscriptionsRawService implements SubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated
     *
     * @api
     *
     * @param array{
     *   billing: BillingAddress|BillingAddressShape,
     *   customer: CustomerRequestShape,
     *   productID: string,
     *   quantity: int,
     *   addons?: list<AttachAddon|AttachAddonShape>|null,
     *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
     *   billingCurrency?: value-of<Currency>,
     *   discountCode?: string|null,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>,
     *   onDemand?: OnDemandSubscription|OnDemandSubscriptionShape|null,
     *   oneTimeProductCart?: list<OneTimeProductCartItem|OneTimeProductCartItemShape>|null,
     *   paymentLink?: bool|null,
     *   paymentMethodID?: string|null,
     *   redirectImmediately?: bool,
     *   returnURL?: string|null,
     *   shortLink?: bool|null,
     *   showSavedPaymentMethods?: bool,
     *   taxID?: string|null,
     *   trialPeriodDays?: int|null,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'subscriptions',
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionNewResponse::class,
        );
    }

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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s', $subscriptionID],
            options: $requestOptions,
            convert: Subscription::class,
        );
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   billing?: BillingAddress|BillingAddressShape|null,
     *   cancelAtNextBillingDate?: bool|null,
     *   customerName?: string|null,
     *   disableOnDemand?: DisableOnDemand|DisableOnDemandShape|null,
     *   metadata?: array<string,string>|null,
     *   nextBillingDate?: \DateTimeInterface|null,
     *   status?: SubscriptionStatus|value-of<SubscriptionStatus>|null,
     *   taxID?: string|null,
     * }|SubscriptionUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['subscriptions/%1$s', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: Subscription::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   brandID?: string,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status|value-of<Status>,
     * }|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<SubscriptionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'subscriptions',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: SubscriptionListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   productID: string,
     *   prorationBillingMode: ProrationBillingMode|value-of<ProrationBillingMode>,
     *   quantity: int,
     *   addons?: list<AttachAddon|AttachAddonShape>|null,
     *   metadata?: array<string,string>|null,
     * }|SubscriptionChangePlanParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionChangePlanParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/change-plan', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   productPrice: int,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   customerBalanceConfig?: CustomerBalanceConfig|CustomerBalanceConfigShape|null,
     *   metadata?: array<string,string>|null,
     *   productCurrency?: value-of<Currency>,
     *   productDescription?: string|null,
     * }|SubscriptionChargeParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionChargeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/charge', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionChargeResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   productID: string,
     *   prorationBillingMode: SubscriptionPreviewChangePlanParams\ProrationBillingMode|value-of<SubscriptionPreviewChangePlanParams\ProrationBillingMode>,
     *   quantity: int,
     *   addons?: list<AttachAddon|AttachAddonShape>|null,
     *   metadata?: array<string,string>|null,
     * }|SubscriptionPreviewChangePlanParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionPreviewChangePlanParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/change-plan/preview', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionPreviewChangePlanResponse::class,
        );
    }

    /**
     * @api
     *
     * Get detailed usage history for a subscription that includes usage-based billing (metered components).
     * This endpoint provides insights into customer usage patterns and billing calculations over time.
     *
     * ## What You'll Get:
     * - **Billing periods**: Each item represents a billing cycle with start and end dates
     * - **Meter usage**: Detailed breakdown of usage for each meter configured on the subscription
     * - **Usage calculations**: Total units consumed, free threshold units, and chargeable units
     * - **Historical tracking**: Complete audit trail of usage-based charges
     *
     * ## Use Cases:
     * - **Customer support**: Investigate billing questions and usage discrepancies
     * - **Usage analytics**: Analyze customer consumption patterns over time
     * - **Billing transparency**: Provide customers with detailed usage breakdowns
     * - **Revenue optimization**: Identify usage trends to optimize pricing strategies
     *
     * ## Filtering Options:
     * - **Date range filtering**: Get usage history for specific time periods
     * - **Meter-specific filtering**: Focus on usage for a particular meter
     * - **Pagination**: Navigate through large usage histories efficiently
     *
     * ## Important Notes:
     * - Only returns data for subscriptions with usage-based (metered) components
     * - Usage history is organized by billing periods (subscription cycles)
     * - Free threshold units are calculated and displayed separately from chargeable units
     * - Historical data is preserved even if meter configurations change
     *
     * ## Example Query Patterns:
     * - Get last 3 months: `?start_date=2024-01-01T00:00:00Z&end_date=2024-03-31T23:59:59Z`
     * - Filter by meter: `?meter_id=mtr_api_requests`
     * - Paginate results: `?page_size=20&page_number=1`
     * - Recent usage: `?start_date=2024-03-01T00:00:00Z` (from March 1st to now)
     *
     * @param string $subscriptionID Unique subscription identifier
     * @param array{
     *   endDate?: \DateTimeInterface|null,
     *   meterID?: string|null,
     *   pageNumber?: int|null,
     *   pageSize?: int|null,
     *   startDate?: \DateTimeInterface|null,
     * }|SubscriptionRetrieveUsageHistoryParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionRetrieveUsageHistoryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s/usage-history', $subscriptionID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'endDate' => 'end_date',
                    'meterID' => 'meter_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'startDate' => 'start_date',
                ],
            ),
            options: $options,
            convert: SubscriptionGetUsageHistoryResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   type: Type|value-of<Type>, returnURL?: string|null, paymentMethodID: string
     * }|SubscriptionUpdatePaymentMethodParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionUpdatePaymentMethodParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/update-payment-method', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionUpdatePaymentMethodResponse::class,
        );
    }
}
