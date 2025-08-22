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
use Dodopayments\Subscriptions\OnDemandSubscription;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

interface SubscriptionsContract
{
    /**
     * @param BillingAddress $billing Billing address information for the subscription
     * @param AttachExistingCustomer|NewCustomer $customer Customer details for the subscription
     * @param string $productID Unique identifier of the product to subscribe to
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon>|null $addons Attach addons to this subscription
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param Currency::* $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the subscription
     * @param array<string, string> $metadata Additional metadata for the subscription
     * Defaults to empty if not specified
     * @param OnDemandSubscription $onDemand
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
        $addons = null,
        $allowedPaymentMethodTypes = null,
        $billingCurrency = null,
        $discountCode = null,
        $metadata = null,
        $onDemand = null,
        $paymentLink = null,
        $returnURL = null,
        $showSavedPaymentMethods = null,
        $taxID = null,
        $trialPeriodDays = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse;

    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription;

    /**
     * @param BillingAddress $billing
     * @param bool|null $cancelAtNextBillingDate When set, the subscription will remain active until the end of billing period
     * @param DisableOnDemand|null $disableOnDemand
     * @param array<string, string>|null $metadata
     * @param \DateTimeInterface|null $nextBillingDate
     * @param SubscriptionStatus::* $status
     * @param string|null $taxID
     */
    public function update(
        string $subscriptionID,
        $billing = null,
        $cancelAtNextBillingDate = null,
        $disableOnDemand = null,
        $metadata = null,
        $nextBillingDate = null,
        $status = null,
        $taxID = null,
        ?RequestOptions $requestOptions = null,
    ): Subscription;

    /**
     * @param string $brandID filter by Brand id
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status::* $status Filter by status
     */
    public function list(
        $brandID = null,
        $createdAtGte = null,
        $createdAtLte = null,
        $customerID = null,
        $pageNumber = null,
        $pageSize = null,
        $status = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionListResponse;

    /**
     * @param string $productID Unique identifier of the product to subscribe to
     * @param ProrationBillingMode::* $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<AttachAddon>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     */
    public function changePlan(
        string $subscriptionID,
        $productID,
        $prorationBillingMode,
        $quantity,
        $addons = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param int $productPrice The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * @param bool|null $adaptiveCurrencyFeesInclusive Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     * @param array<string,
     * string,>|null $metadata Metadata for the payment. If not passed, the metadata of the subscription will be taken
     * @param Currency::* $productCurrency Optional currency of the product price. If not specified, defaults to the currency of the product.
     * @param string|null $productDescription Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function charge(
        string $subscriptionID,
        $productPrice,
        $adaptiveCurrencyFeesInclusive = null,
        $metadata = null,
        $productCurrency = null,
        $productDescription = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse;
}
