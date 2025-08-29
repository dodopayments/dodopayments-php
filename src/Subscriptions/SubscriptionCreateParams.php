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
 * @see Dodopayments\Subscriptions->create
 *
 * @phpstan-type subscription_create_params = array{
 *   billing: BillingAddress,
 *   customer: AttachExistingCustomer|NewCustomer,
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes::*>|null,
 *   billingCurrency?: Currency::*,
 *   discountCode?: string|null,
 *   metadata?: array<string, string>,
 *   onDemand?: OnDemandSubscription,
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
 *   taxID?: string|null,
 *   trialPeriodDays?: int|null,
 * }
 */
final class SubscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<subscription_create_params> */
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
    #[Api('product_id')]
    public string $productID;

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
     * @var list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes
     */
    #[Api(
        'allowed_payment_method_types',
        list: PaymentMethodTypes::class,
        nullable: true,
        optional: true,
    )]
    public ?array $allowedPaymentMethodTypes;

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @var Currency::*|null $billingCurrency
     */
    #[Api(
        'billing_currency',
        enum: Currency::class,
        nullable: true,
        optional: true
    )]
    public ?string $billingCurrency;

    /**
     * Discount Code to apply to the subscription.
     */
    #[Api('discount_code', nullable: true, optional: true)]
    public ?string $discountCode;

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    #[Api('on_demand', nullable: true, optional: true)]
    public ?OnDemandSubscription $onDemand;

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    #[Api('payment_link', nullable: true, optional: true)]
    public ?bool $paymentLink;

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    #[Api('return_url', nullable: true, optional: true)]
    public ?string $returnURL;

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    #[Api('show_saved_payment_methods', optional: true)]
    public ?bool $showSavedPaymentMethods;

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    #[Api('tax_id', nullable: true, optional: true)]
    public ?string $taxID;

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    #[Api('trial_period_days', nullable: true, optional: true)]
    public ?int $trialPeriodDays;

    /**
     * `new SubscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCreateParams::with(
     *   billing: ..., customer: ..., productID: ..., quantity: ...
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AttachAddon>|null $addons
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes
     * @param Currency::* $billingCurrency
     * @param array<string, string> $metadata
     */
    public static function with(
        BillingAddress $billing,
        AttachExistingCustomer|NewCustomer $customer,
        string $productID,
        int $quantity,
        ?array $addons = null,
        ?array $allowedPaymentMethodTypes = null,
        ?string $billingCurrency = null,
        ?string $discountCode = null,
        ?array $metadata = null,
        ?OnDemandSubscription $onDemand = null,
        ?bool $paymentLink = null,
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
    ): self {
        $obj = new self;

        $obj->billing = $billing;
        $obj->customer = $customer;
        $obj->productID = $productID;
        $obj->quantity = $quantity;

        null !== $addons && $obj->addons = $addons;
        null !== $allowedPaymentMethodTypes && $obj->allowedPaymentMethodTypes = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $obj->billingCurrency = $billingCurrency;
        null !== $discountCode && $obj->discountCode = $discountCode;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $onDemand && $obj->onDemand = $onDemand;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;
        null !== $returnURL && $obj->returnURL = $returnURL;
        null !== $showSavedPaymentMethods && $obj->showSavedPaymentMethods = $showSavedPaymentMethods;
        null !== $taxID && $obj->taxID = $taxID;
        null !== $trialPeriodDays && $obj->trialPeriodDays = $trialPeriodDays;

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
        $obj->productID = $productID;

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
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes
     */
    public function withAllowedPaymentMethodTypes(
        ?array $allowedPaymentMethodTypes
    ): self {
        $obj = clone $this;
        $obj->allowedPaymentMethodTypes = $allowedPaymentMethodTypes;

        return $obj;
    }

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @param Currency::* $billingCurrency
     */
    public function withBillingCurrency(string $billingCurrency): self
    {
        $obj = clone $this;
        $obj->billingCurrency = $billingCurrency;

        return $obj;
    }

    /**
     * Discount Code to apply to the subscription.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj->discountCode = $discountCode;

        return $obj;
    }

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withOnDemand(OnDemandSubscription $onDemand): self
    {
        $obj = clone $this;
        $obj->onDemand = $onDemand;

        return $obj;
    }

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $obj = clone $this;
        $obj->paymentLink = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj->returnURL = $returnURL;

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
        $obj->showSavedPaymentMethods = $showSavedPaymentMethods;

        return $obj;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj->taxID = $taxID;

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
        $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }
}
