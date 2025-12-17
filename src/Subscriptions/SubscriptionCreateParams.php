<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @deprecated
 * @see Dodopayments\Services\SubscriptionsService::create()
 *
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 * @phpstan-import-type OnDemandSubscriptionShape from \Dodopayments\Subscriptions\OnDemandSubscription
 * @phpstan-import-type OneTimeProductCartItemShape from \Dodopayments\Payments\OneTimeProductCartItem
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   billing: BillingAddressShape,
 *   customer: CustomerRequestShape,
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddonShape>|null,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   discountCode?: string|null,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>|null,
 *   onDemand?: OnDemandSubscriptionShape|null,
 *   oneTimeProductCart?: list<OneTimeProductCartItemShape>|null,
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool|null,
 *   taxID?: string|null,
 *   trialPeriodDays?: int|null,
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
    #[Required]
    public BillingAddress $billing;

    /**
     * Customer details for the subscription.
     */
    #[Required]
    public AttachExistingCustomer|NewCustomer $customer;

    /**
     * Unique identifier of the product to subscribe to.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    #[Required]
    public int $quantity;

    /**
     * Attach addons to this subscription.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Optional(list: AttachAddon::class, nullable: true)]
    public ?array $addons;

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @var list<value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     */
    #[Optional(
        'allowed_payment_method_types',
        list: PaymentMethodTypes::class,
        nullable: true,
    )]
    public ?array $allowedPaymentMethodTypes;

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @var value-of<Currency>|null $billingCurrency
     */
    #[Optional('billing_currency', enum: Currency::class, nullable: true)]
    public ?string $billingCurrency;

    /**
     * Discount Code to apply to the subscription.
     */
    #[Optional('discount_code', nullable: true)]
    public ?string $discountCode;

    /**
     * Override merchant default 3DS behaviour for this subscription.
     */
    #[Optional('force_3ds', nullable: true)]
    public ?bool $force3DS;

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    #[Optional('on_demand', nullable: true)]
    public ?OnDemandSubscription $onDemand;

    /**
     * List of one time products that will be bundled with the first payment for this subscription.
     *
     * @var list<OneTimeProductCartItem>|null $oneTimeProductCart
     */
    #[Optional(
        'one_time_product_cart',
        list: OneTimeProductCartItem::class,
        nullable: true
    )]
    public ?array $oneTimeProductCart;

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    #[Optional('payment_link', nullable: true)]
    public ?bool $paymentLink;

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    #[Optional('show_saved_payment_methods')]
    public ?bool $showSavedPaymentMethods;

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    #[Optional('trial_period_days', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BillingAddressShape $billing
     * @param CustomerRequestShape $customer
     * @param list<AttachAddonShape>|null $addons
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param array<string,string> $metadata
     * @param OnDemandSubscriptionShape|null $onDemand
     * @param list<OneTimeProductCartItemShape>|null $oneTimeProductCart
     */
    public static function with(
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
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
    ): self {
        $self = new self;

        $self['billing'] = $billing;
        $self['customer'] = $customer;
        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;
        null !== $allowedPaymentMethodTypes && $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $self['billingCurrency'] = $billingCurrency;
        null !== $discountCode && $self['discountCode'] = $discountCode;
        null !== $force3DS && $self['force3DS'] = $force3DS;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $onDemand && $self['onDemand'] = $onDemand;
        null !== $oneTimeProductCart && $self['oneTimeProductCart'] = $oneTimeProductCart;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $returnURL && $self['returnURL'] = $returnURL;
        null !== $showSavedPaymentMethods && $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $taxID && $self['taxID'] = $taxID;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    /**
     * Billing address information for the subscription.
     *
     * @param BillingAddressShape $billing
     */
    public function withBilling(BillingAddress|array $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    /**
     * Customer details for the subscription.
     *
     * @param CustomerRequestShape $customer
     */
    public function withCustomer(
        AttachExistingCustomer|array|NewCustomer $customer
    ): self {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Attach addons to this subscription.
     *
     * @param list<AttachAddonShape>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
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
        $self = clone $this;
        $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;

        return $self;
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
        $self = clone $this;
        $self['billingCurrency'] = $billingCurrency;

        return $self;
    }

    /**
     * Discount Code to apply to the subscription.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $self = clone $this;
        $self['discountCode'] = $discountCode;

        return $self;
    }

    /**
     * Override merchant default 3DS behaviour for this subscription.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $self = clone $this;
        $self['force3DS'] = $force3DS;

        return $self;
    }

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param OnDemandSubscriptionShape|null $onDemand
     */
    public function withOnDemand(
        OnDemandSubscription|array|null $onDemand
    ): self {
        $self = clone $this;
        $self['onDemand'] = $onDemand;

        return $self;
    }

    /**
     * List of one time products that will be bundled with the first payment for this subscription.
     *
     * @param list<OneTimeProductCartItemShape>|null $oneTimeProductCart
     */
    public function withOneTimeProductCart(?array $oneTimeProductCart): self
    {
        $self = clone $this;
        $self['oneTimeProductCart'] = $oneTimeProductCart;

        return $self;
    }

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $self = clone $this;
        $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;

        return $self;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }
}
