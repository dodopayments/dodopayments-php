<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @see Dodopayments\Services\SubscriptionsService::create()
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   billing: BillingAddress,
 *   customer: AttachExistingCustomer|NewCustomer,
 *   product_id: string,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
 *   allowed_payment_method_types?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billing_currency?: null|Currency|value-of<Currency>,
 *   discount_code?: string|null,
 *   force_3ds?: bool|null,
 *   metadata?: array<string,string>,
 *   on_demand?: OnDemandSubscription|null,
 *   payment_link?: bool|null,
 *   return_url?: string|null,
 *   show_saved_payment_methods?: bool,
 *   tax_id?: string|null,
 *   trial_period_days?: int|null,
 * }
 */
final class SubscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Billing address information for the subscription.
     */
    #[Api]
    public BillingAddress $billing;

    /**
     * Customer details for the subscription.
     */
    #[Api]
    public AttachExistingCustomer|NewCustomer $customer;

    /**
     * Unique identifier of the product to subscribe to.
     */
    #[Api]
    public string $product_id;

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    #[Api]
    public int $quantity;

    /**
     * Attach addons to this subscription.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Api(list: AttachAddon::class, nullable: true, optional: true)]
    public ?array $addons;

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @var list<value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     */
    #[Api(list: PaymentMethodTypes::class, nullable: true, optional: true)]
    public ?array $allowed_payment_method_types;

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @var value-of<Currency>|null $billing_currency
     */
    #[Api(enum: Currency::class, nullable: true, optional: true)]
    public ?string $billing_currency;

    /**
     * Discount Code to apply to the subscription.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $discount_code;

    /**
     * Override merchant default 3DS behaviour for this subscription.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $force_3ds;

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    #[Api(nullable: true, optional: true)]
    public ?OnDemandSubscription $on_demand;

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $payment_link;

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $return_url;

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    #[Api(optional: true)]
    public ?bool $show_saved_payment_methods;

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tax_id;

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $trial_period_days;

    /**
     * `new SubscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCreateParams::with(
     *   billing: ..., customer: ..., product_id: ..., quantity: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionCreateParams)
     *   ->withBilling(...)
     *   ->withCustomer(...)
     *   ->withProductID(...)
     *   ->withQuantity(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AttachAddon>|null $addons
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     * @param Currency|value-of<Currency>|null $billing_currency
     * @param array<string,string> $metadata
     */
    public static function with(
        BillingAddress $billing,
        AttachExistingCustomer|NewCustomer $customer,
        string $product_id,
        int $quantity,
        ?array $addons = null,
        ?array $allowed_payment_method_types = null,
        Currency|string|null $billing_currency = null,
        ?string $discount_code = null,
        ?bool $force_3ds = null,
        ?array $metadata = null,
        ?OnDemandSubscription $on_demand = null,
        ?bool $payment_link = null,
        ?string $return_url = null,
        ?bool $show_saved_payment_methods = null,
        ?string $tax_id = null,
        ?int $trial_period_days = null,
    ): self {
        $obj = new self;

        $obj->billing = $billing;
        $obj->customer = $customer;
        $obj->product_id = $product_id;
        $obj->quantity = $quantity;

        null !== $addons && $obj->addons = $addons;
        null !== $allowed_payment_method_types && $obj['allowed_payment_method_types'] = $allowed_payment_method_types;
        null !== $billing_currency && $obj['billing_currency'] = $billing_currency;
        null !== $discount_code && $obj->discount_code = $discount_code;
        null !== $force_3ds && $obj->force_3ds = $force_3ds;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $on_demand && $obj->on_demand = $on_demand;
        null !== $payment_link && $obj->payment_link = $payment_link;
        null !== $return_url && $obj->return_url = $return_url;
        null !== $show_saved_payment_methods && $obj->show_saved_payment_methods = $show_saved_payment_methods;
        null !== $tax_id && $obj->tax_id = $tax_id;
        null !== $trial_period_days && $obj->trial_period_days = $trial_period_days;

        return $obj;
    }

    /**
     * Billing address information for the subscription.
     */
    public function withBilling(BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * Customer details for the subscription.
     */
    public function withCustomer(
        AttachExistingCustomer|NewCustomer $customer
    ): self {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->product_id = $productID;

        return $obj;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }

    /**
     * Attach addons to this subscription.
     *
     * @param list<AttachAddon>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
    }

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     */
    public function withAllowedPaymentMethodTypes(
        ?array $allowedPaymentMethodTypes
    ): self {
        $obj = clone $this;
        $obj['allowed_payment_method_types'] = $allowedPaymentMethodTypes;

        return $obj;
    }

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @param Currency|value-of<Currency>|null $billingCurrency
     */
    public function withBillingCurrency(
        Currency|string|null $billingCurrency
    ): self {
        $obj = clone $this;
        $obj['billing_currency'] = $billingCurrency;

        return $obj;
    }

    /**
     * Discount Code to apply to the subscription.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj->discount_code = $discountCode;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this subscription.
     */
    public function withForce3DS(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj->force_3ds = $force3DS;

        return $obj;
    }

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withOnDemand(?OnDemandSubscription $onDemand): self
    {
        $obj = clone $this;
        $obj->on_demand = $onDemand;

        return $obj;
    }

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $obj = clone $this;
        $obj->payment_link = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj->return_url = $returnURL;

        return $obj;
    }

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $obj = clone $this;
        $obj->show_saved_payment_methods = $showSavedPaymentMethods;

        return $obj;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj->tax_id = $taxID;

        return $obj;
    }

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trial_period_days = $trialPeriodDays;

        return $obj;
    }
}
