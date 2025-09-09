<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\SubscriptionsContract;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\OnDemandSubscription;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionRetrieveUsageHistoryParams;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

use const Dodopayments\Core\OMIT as omit;

final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param BillingAddress $billing Billing address information for the subscription
     * @param AttachExistingCustomer|NewCustomer $customer Customer details for the subscription
     * @param string $productID Unique identifier of the product to subscribe to
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon>|null $addons Attach addons to this subscription
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency|value-of<Currency>|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the subscription
     * @param array<string, string> $metadata Additional metadata for the subscription
     * Defaults to empty if not specified
     * @param OnDemandSubscription|null $onDemand
     * @param bool|null $paymentLink If true, generates a payment link.
     * Defaults to false if not specified.
     * @param string|null $returnURL Optional URL to redirect after successful subscription creation
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     * @param int|null $trialPeriodDays Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days
     */
    public function create(
        $billing,
        $customer,
        $productID,
        $quantity,
        $addons = omit,
        $allowedPaymentMethodTypes = omit,
        $billingCurrency = omit,
        $discountCode = omit,
        $metadata = omit,
        $onDemand = omit,
        $paymentLink = omit,
        $returnURL = omit,
        $showSavedPaymentMethods = omit,
        $taxID = omit,
        $trialPeriodDays = omit,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            [
                'billing' => $billing,
                'customer' => $customer,
                'productID' => $productID,
                'quantity' => $quantity,
                'addons' => $addons,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingCurrency' => $billingCurrency,
                'discountCode' => $discountCode,
                'metadata' => $metadata,
                'onDemand' => $onDemand,
                'paymentLink' => $paymentLink,
                'returnURL' => $returnURL,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'taxID' => $taxID,
                'trialPeriodDays' => $trialPeriodDays,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     */
    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription {
        // @phpstan-ignore-next-line;
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
     * @param BillingAddress|null $billing
     * @param bool|null $cancelAtNextBillingDate When set, the subscription will remain active until the end of billing period
     * @param DisableOnDemand|null $disableOnDemand
     * @param array<string, string>|null $metadata
     * @param \DateTimeInterface|null $nextBillingDate
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     * @param string|null $taxID
     */
    public function update(
        string $subscriptionID,
        $billing = omit,
        $cancelAtNextBillingDate = omit,
        $disableOnDemand = omit,
        $metadata = omit,
        $nextBillingDate = omit,
        $status = omit,
        $taxID = omit,
        ?RequestOptions $requestOptions = null,
    ): Subscription {
        [$parsed, $options] = SubscriptionUpdateParams::parseRequest(
            [
                'billing' => $billing,
                'cancelAtNextBillingDate' => $cancelAtNextBillingDate,
                'disableOnDemand' => $disableOnDemand,
                'metadata' => $metadata,
                'nextBillingDate' => $nextBillingDate,
                'status' => $status,
                'taxID' => $taxID,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param string $brandID filter by Brand id
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status|value-of<Status> $status Filter by status
     *
     * @return DefaultPageNumberPagination<SubscriptionListResponse>
     */
    public function list(
        $brandID = omit,
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $status = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            [
                'brandID' => $brandID,
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'subscriptions',
            query: $parsed,
            options: $options,
            convert: SubscriptionListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $productID Unique identifier of the product to subscribe to
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     */
    public function changePlan(
        string $subscriptionID,
        $productID,
        $prorationBillingMode,
        $quantity,
        $addons = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionChangePlanParams::parseRequest(
            [
                'productID' => $productID,
                'prorationBillingMode' => $prorationBillingMode,
                'quantity' => $quantity,
                'addons' => $addons,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param int $productPrice The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * @param bool|null $adaptiveCurrencyFeesInclusive Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     * @param array<string,
     * string,>|null $metadata Metadata for the payment. If not passed, the metadata of the subscription will be taken
     * @param Currency|value-of<Currency>|null $productCurrency Optional currency of the product price. If not specified, defaults to the currency of the product.
     * @param string|null $productDescription Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function charge(
        string $subscriptionID,
        $productPrice,
        $adaptiveCurrencyFeesInclusive = omit,
        $metadata = omit,
        $productCurrency = omit,
        $productDescription = omit,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse {
        [$parsed, $options] = SubscriptionChargeParams::parseRequest(
            [
                'productPrice' => $productPrice,
                'adaptiveCurrencyFeesInclusive' => $adaptiveCurrencyFeesInclusive,
                'metadata' => $metadata,
                'productCurrency' => $productCurrency,
                'productDescription' => $productDescription,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param \DateTimeInterface|null $endDate Filter by end date (inclusive)
     * @param string|null $meterID Filter by specific meter ID
     * @param int|null $pageNumber Page number (default: 0)
     * @param int|null $pageSize Page size (default: 10, max: 100)
     * @param \DateTimeInterface|null $startDate Filter by start date (inclusive)
     *
     * @return DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse>
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        $endDate = omit,
        $meterID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $startDate = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = SubscriptionRetrieveUsageHistoryParams::parseRequest(
            [
                'endDate' => $endDate,
                'meterID' => $meterID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'startDate' => $startDate,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s/usage-history', $subscriptionID],
            query: $parsed,
            options: $options,
            convert: SubscriptionGetUsageHistoryResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
