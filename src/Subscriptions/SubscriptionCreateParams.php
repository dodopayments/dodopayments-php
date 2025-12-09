<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @see Dodopayments\Services\SubscriptionsService::create()
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   billing: BillingAddress|array{
 *     country: value-of<CountryCode>,
 *     city?: string|null,
 *     state?: string|null,
 *     street?: string|null,
 *     zipcode?: string|null,
 *   },
 *   customer: AttachExistingCustomer|array{customerID: string}|NewCustomer|array{
 *     email: string, name?: string|null, phoneNumber?: string|null
 *   },
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddon|array{addonID: string, quantity: int}>|null,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   discountCode?: string|null,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>,
 *   onDemand?: null|OnDemandSubscription|array{
 *     mandateOnly: bool,
 *     adaptiveCurrencyFeesInclusive?: bool|null,
 *     productCurrency?: value-of<Currency>|null,
 *     productDescription?: string|null,
 *     productPrice?: int|null,
 *   },
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
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
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * } $billing
     * @param AttachExistingCustomer|array{customerID: string}|NewCustomer|array{
     *   email: string, name?: string|null, phoneNumber?: string|null
     * } $customer
     * @param list<AttachAddon|array{addonID: string, quantity: int}>|null $addons
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param array<string,string> $metadata
     * @param OnDemandSubscription|array{
     *   mandateOnly: bool,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   productCurrency?: value-of<Currency>|null,
     *   productDescription?: string|null,
     *   productPrice?: int|null,
     * }|null $onDemand
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
        ?bool $paymentLink = null,
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
    ): self {
        $obj = new self;

        $obj['billing'] = $billing;
        $obj['customer'] = $customer;
        $obj['productID'] = $productID;
        $obj['quantity'] = $quantity;

        null !== $addons && $obj['addons'] = $addons;
        null !== $allowedPaymentMethodTypes && $obj['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $obj['billingCurrency'] = $billingCurrency;
        null !== $discountCode && $obj['discountCode'] = $discountCode;
        null !== $force3DS && $obj['force3DS'] = $force3DS;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $onDemand && $obj['onDemand'] = $onDemand;
        null !== $paymentLink && $obj['paymentLink'] = $paymentLink;
        null !== $returnURL && $obj['returnURL'] = $returnURL;
        null !== $showSavedPaymentMethods && $obj['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $taxID && $obj['taxID'] = $taxID;
        null !== $trialPeriodDays && $obj['trialPeriodDays'] = $trialPeriodDays;

        return $obj;
    }

    /**
     * Billing address information for the subscription.
     *
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * } $billing
     */
    public function withBilling(BillingAddress|array $billing): self
    {
        $obj = clone $this;
        $obj['billing'] = $billing;

        return $obj;
    }

    /**
     * Customer details for the subscription.
     *
     * @param AttachExistingCustomer|array{customerID: string}|NewCustomer|array{
     *   email: string, name?: string|null, phoneNumber?: string|null
     * } $customer
     */
    public function withCustomer(
        AttachExistingCustomer|array|NewCustomer $customer
    ): self {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['productID'] = $productID;

        return $obj;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * Attach addons to this subscription.
     *
     * @param list<AttachAddon|array{addonID: string, quantity: int}>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj['addons'] = $addons;

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
        $obj['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;

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
        $obj['billingCurrency'] = $billingCurrency;

        return $obj;
    }

    /**
     * Discount Code to apply to the subscription.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj['discountCode'] = $discountCode;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this subscription.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj['force3DS'] = $force3DS;

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
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * @param OnDemandSubscription|array{
     *   mandateOnly: bool,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   productCurrency?: value-of<Currency>|null,
     *   productDescription?: string|null,
     *   productPrice?: int|null,
     * }|null $onDemand
     */
    public function withOnDemand(
        OnDemandSubscription|array|null $onDemand
    ): self {
        $obj = clone $this;
        $obj['onDemand'] = $onDemand;

        return $obj;
    }

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $obj = clone $this;
        $obj['paymentLink'] = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj['returnURL'] = $returnURL;

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
        $obj['showSavedPaymentMethods'] = $showSavedPaymentMethods;

        return $obj;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj['taxID'] = $taxID;

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
        $obj['trialPeriodDays'] = $trialPeriodDays;

        return $obj;
    }
}
