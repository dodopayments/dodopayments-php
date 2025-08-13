<?php

declare(strict_types=1);

namespace DodopaymentsClient\Subscriptions;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\Core\Conversion\MapOf;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\AttachExistingCustomer;
use DodopaymentsClient\Payments\BillingAddress;
use DodopaymentsClient\Payments\NewCustomer;
use DodopaymentsClient\Payments\PaymentMethodTypes;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams\OnDemand;

/**
 * @phpstan-type create_params = array{
 *   billing: BillingAddress,
 *   customer: AttachExistingCustomer|NewCustomer,
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes::*>|null,
 *   billingCurrency?: Currency::*,
 *   discountCode?: string|null,
 *   metadata?: array<string, string>,
 *   onDemand?: OnDemand|null,
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
 *   taxID?: string|null,
 *   trialPeriodDays?: int|null,
 * }
 */
final class SubscriptionCreateParams implements BaseModel
{
    use Model;
    use Params;

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
     * @var null|list<AttachAddon> $addons
     */
    #[Api(type: new ListOf(AttachAddon::class), nullable: true, optional: true)]
    public ?array $addons;

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @var null|list<PaymentMethodTypes::*> $allowedPaymentMethodTypes
     */
    #[Api(
        'allowed_payment_method_types',
        type: new ListOf(enum: PaymentMethodTypes::class),
        nullable: true,
        optional: true,
    )]
    public ?array $allowedPaymentMethodTypes;

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @var null|Currency::* $billingCurrency
     */
    #[Api('billing_currency', enum: Currency::class, optional: true)]
    public ?string $billingCurrency;

    /**
     * Discount Code to apply to the subscription.
     */
    #[Api('discount_code', optional: true)]
    public ?string $discountCode;

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $metadata;

    #[Api('on_demand', optional: true)]
    public ?OnDemand $onDemand;

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    #[Api('payment_link', optional: true)]
    public ?bool $paymentLink;

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    #[Api('return_url', optional: true)]
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
    #[Api('tax_id', optional: true)]
    public ?string $taxID;

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    #[Api('trial_period_days', optional: true)]
    public ?int $trialPeriodDays;

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
     * @param null|list<AttachAddon> $addons
     * @param null|list<PaymentMethodTypes::*> $allowedPaymentMethodTypes
     * @param Currency::* $billingCurrency
     * @param null|array<string, string> $metadata
     */
    public static function from(
        BillingAddress $billing,
        AttachExistingCustomer|NewCustomer $customer,
        string $productID,
        int $quantity,
        ?array $addons = null,
        ?array $allowedPaymentMethodTypes = null,
        ?string $billingCurrency = null,
        ?string $discountCode = null,
        ?array $metadata = null,
        ?OnDemand $onDemand = null,
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
    public function setBilling(BillingAddress $billing): self
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * Customer details for the subscription.
     */
    public function setCustomer(
        AttachExistingCustomer|NewCustomer $customer
    ): self {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Attach addons to this subscription.
     *
     * @param null|list<AttachAddon> $addons
     */
    public function setAddons(?array $addons): self
    {
        $this->addons = $addons;

        return $this;
    }

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @param null|list<PaymentMethodTypes::*> $allowedPaymentMethodTypes
     */
    public function setAllowedPaymentMethodTypes(
        ?array $allowedPaymentMethodTypes
    ): self {
        $this->allowedPaymentMethodTypes = $allowedPaymentMethodTypes;

        return $this;
    }

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @param Currency::* $billingCurrency
     */
    public function setBillingCurrency(string $billingCurrency): self
    {
        $this->billingCurrency = $billingCurrency;

        return $this;
    }

    /**
     * Discount Code to apply to the subscription.
     */
    public function setDiscountCode(?string $discountCode): self
    {
        $this->discountCode = $discountCode;

        return $this;
    }

    /**
     * Additional metadata for the subscription
     * Defaults to empty if not specified.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setOnDemand(?OnDemand $onDemand): self
    {
        $this->onDemand = $onDemand;

        return $this;
    }

    /**
     * If true, generates a payment link.
     * Defaults to false if not specified.
     */
    public function setPaymentLink(?bool $paymentLink): self
    {
        $this->paymentLink = $paymentLink;

        return $this;
    }

    /**
     * Optional URL to redirect after successful subscription creation.
     */
    public function setReturnURL(?string $returnURL): self
    {
        $this->returnURL = $returnURL;

        return $this;
    }

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    public function setShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $this->showSavedPaymentMethods = $showSavedPaymentMethods;

        return $this;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function setTaxID(?string $taxID): self
    {
        $this->taxID = $taxID;

        return $this;
    }

    /**
     * Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days.
     */
    public function setTrialPeriodDays(?int $trialPeriodDays): self
    {
        $this->trialPeriodDays = $trialPeriodDays;

        return $this;
    }
}
