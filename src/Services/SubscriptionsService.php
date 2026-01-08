<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\SubscriptionsContract;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\OnDemandSubscription;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionChargeParams\CustomerBalanceConfig;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;
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
final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @deprecated
     *
     * @api
     *
     * @param BillingAddress|BillingAddressShape $billing Billing address information for the subscription
     * @param CustomerRequestShape $customer Customer details for the subscription
     * @param string $productID Unique identifier of the product to subscribe to
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon|AttachAddonShape>|null $addons Attach addons to this subscription
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency|value-of<Currency>|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the subscription
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this subscription
     * @param array<string,string> $metadata Additional metadata for the subscription
     * Defaults to empty if not specified
     * @param OnDemandSubscription|OnDemandSubscriptionShape|null $onDemand
     * @param list<OneTimeProductCartItem|OneTimeProductCartItemShape>|null $oneTimeProductCart List of one time products that will be bundled with the first payment for this subscription
     * @param bool|null $paymentLink If true, generates a payment link.
     * Defaults to false if not specified.
     * @param string|null $paymentMethodID Optional payment method ID to use for this subscription.
     * If provided, customer_id must also be provided (via AttachExistingCustomer).
     * The payment method will be validated for eligibility with the subscription's currency.
     * @param bool $redirectImmediately If true, redirects the customer immediately after payment completion
     * False by default
     * @param string|null $returnURL Optional URL to redirect after successful subscription creation
     * @param bool|null $shortLink If true, returns a shortened payment link.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     * @param int|null $trialPeriodDays Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        BillingAddress|array $billing,
        AttachExistingCustomer|array|NewCustomer $customer,
        string $productID,
        int $quantity,
        ?array $addons = null,
        ?array $allowedPaymentMethodTypes = null,
        Currency|string|null $billingCurrency = null,
        ?string $discountCode = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        OnDemandSubscription|array|null $onDemand = null,
        ?array $oneTimeProductCart = null,
        ?bool $paymentLink = null,
        ?string $paymentMethodID = null,
        ?bool $redirectImmediately = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionNewResponse {
        $params = Util::removeNulls(
            [
                'billing' => $billing,
                'customer' => $customer,
                'productID' => $productID,
                'quantity' => $quantity,
                'addons' => $addons,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingCurrency' => $billingCurrency,
                'discountCode' => $discountCode,
                'force3DS' => $force3DS,
                'metadata' => $metadata,
                'onDemand' => $onDemand,
                'oneTimeProductCart' => $oneTimeProductCart,
                'paymentLink' => $paymentLink,
                'paymentMethodID' => $paymentMethodID,
                'redirectImmediately' => $redirectImmediately,
                'returnURL' => $returnURL,
                'shortLink' => $shortLink,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'taxID' => $taxID,
                'trialPeriodDays' => $trialPeriodDays,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        RequestOptions|array|null $requestOptions = null
    ): Subscription {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($subscriptionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param BillingAddress|BillingAddressShape|null $billing
     * @param bool|null $cancelAtNextBillingDate When set, the subscription will remain active until the end of billing period
     * @param DisableOnDemand|DisableOnDemandShape|null $disableOnDemand
     * @param array<string,string>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        BillingAddress|array|null $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        ?string $customerName = null,
        DisableOnDemand|array|null $disableOnDemand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $nextBillingDate = null,
        SubscriptionStatus|string|null $status = null,
        ?string $taxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Subscription {
        $params = Util::removeNulls(
            [
                'billing' => $billing,
                'cancelAtNextBillingDate' => $cancelAtNextBillingDate,
                'customerName' => $customerName,
                'disableOnDemand' => $disableOnDemand,
                'metadata' => $metadata,
                'nextBillingDate' => $nextBillingDate,
                'status' => $status,
                'taxID' => $taxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<SubscriptionListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?string $brandID = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'brandID' => $brandID,
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param string $productID Unique identifier of the product to subscribe to
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon|AttachAddonShape>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        string $productID,
        ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'productID' => $productID,
                'prorationBillingMode' => $prorationBillingMode,
                'quantity' => $quantity,
                'addons' => $addons,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->changePlan($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param int $productPrice The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * @param bool|null $adaptiveCurrencyFeesInclusive Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     * @param CustomerBalanceConfig|CustomerBalanceConfigShape|null $customerBalanceConfig Specify how customer balance is used for the payment
     * @param array<string,string>|null $metadata Metadata for the payment. If not passed, the metadata of the subscription will be taken
     * @param Currency|value-of<Currency>|null $productCurrency Optional currency of the product price. If not specified, defaults to the currency of the product.
     * @param string|null $productDescription Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        int $productPrice,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        CustomerBalanceConfig|array|null $customerBalanceConfig = null,
        ?array $metadata = null,
        Currency|string|null $productCurrency = null,
        ?string $productDescription = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionChargeResponse {
        $params = Util::removeNulls(
            [
                'productPrice' => $productPrice,
                'adaptiveCurrencyFeesInclusive' => $adaptiveCurrencyFeesInclusive,
                'customerBalanceConfig' => $customerBalanceConfig,
                'metadata' => $metadata,
                'productCurrency' => $productCurrency,
                'productDescription' => $productDescription,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->charge($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param string $productID Unique identifier of the product to subscribe to
     * @param \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode|value-of<\Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode> $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon|AttachAddonShape>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function previewChangePlan(
        string $subscriptionID,
        string $productID,
        \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionPreviewChangePlanResponse {
        $params = Util::removeNulls(
            [
                'productID' => $productID,
                'prorationBillingMode' => $prorationBillingMode,
                'quantity' => $quantity,
                'addons' => $addons,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->previewChangePlan($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param \DateTimeInterface|null $endDate Filter by end date (inclusive)
     * @param string|null $meterID Filter by specific meter ID
     * @param int|null $pageNumber Page number (default: 0)
     * @param int|null $pageSize Page size (default: 10, max: 100)
     * @param \DateTimeInterface|null $startDate Filter by start date (inclusive)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        ?\DateTimeInterface $endDate = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $startDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'endDate' => $endDate,
                'meterID' => $meterID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'startDate' => $startDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveUsageHistory($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param Type|value-of<Type> $type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updatePaymentMethod(
        string $subscriptionID,
        Type|string $type,
        string $paymentMethodID,
        ?string $returnURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionUpdatePaymentMethodResponse {
        $params = Util::removeNulls(
            [
                'type' => $type,
                'returnURL' => $returnURL,
                'paymentMethodID' => $paymentMethodID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updatePaymentMethod($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
