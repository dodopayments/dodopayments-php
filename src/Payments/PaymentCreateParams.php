<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @deprecated
 * @see Dodopayments\Services\PaymentsService::create()
 *
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type OneTimeProductCartItemShape from \Dodopayments\Payments\OneTimeProductCartItem
 *
 * @phpstan-type PaymentCreateParamsShape = array{
 *   billing: BillingAddress|BillingAddressShape,
 *   customer: CustomerRequestShape,
 *   productCart: list<OneTimeProductCartItemShape>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   discountCode?: string|null,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>|null,
 *   paymentLink?: bool|null,
 *   paymentMethodID?: string|null,
 *   redirectImmediately?: bool|null,
 *   returnURL?: string|null,
 *   shortLink?: bool|null,
 *   showSavedPaymentMethods?: bool|null,
 *   taxID?: string|null,
 * }
 */
final class PaymentCreateParams implements BaseModel
{
    /** @use SdkModel<PaymentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Billing address details for the payment.
     */
    #[Required]
    public BillingAddress $billing;

    /**
     * Customer information for the payment.
     */
    #[Required]
    public AttachExistingCustomer|NewCustomer $customer;

    /**
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @var list<OneTimeProductCartItem> $productCart
     */
    #[Required('product_cart', list: OneTimeProductCartItem::class)]
    public array $productCart;

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
     * Discount Code to apply to the transaction.
     */
    #[Optional('discount_code', nullable: true)]
    public ?string $discountCode;

    /**
     * Override merchant default 3DS behaviour for this payment.
     */
    #[Optional('force_3ds', nullable: true)]
    public ?bool $force3DS;

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    #[Optional('payment_link', nullable: true)]
    public ?bool $paymentLink;

    /**
     * Optional payment method ID to use for this payment.
     * If provided, customer_id must also be provided.
     * The payment method will be validated for eligibility with the payment's currency.
     */
    #[Optional('payment_method_id', nullable: true)]
    public ?string $paymentMethodID;

    /**
     * If true, redirects the customer immediately after payment completion
     * False by default.
     */
    #[Optional('redirect_immediately')]
    public ?bool $redirectImmediately;

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     */
    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    /**
     * If true, returns a shortened payment link.
     * Defaults to false if not specified.
     */
    #[Optional('short_link', nullable: true)]
    public ?bool $shortLink;

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
     * `new PaymentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentCreateParams::with(billing: ..., customer: ..., productCart: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentCreateParams)
     *   ->withBilling(...)
     *   ->withCustomer(...)
     *   ->withProductCart(...)
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
     * @param BillingAddress|BillingAddressShape $billing
     * @param CustomerRequestShape $customer
     * @param list<OneTimeProductCartItemShape> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param array<string,string>|null $metadata
     */
    public static function with(
        BillingAddress|array $billing,
        AttachExistingCustomer|array|NewCustomer $customer,
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        Currency|string|null $billingCurrency = null,
        ?string $discountCode = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $paymentLink = null,
        ?string $paymentMethodID = null,
        ?bool $redirectImmediately = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        $self['billing'] = $billing;
        $self['customer'] = $customer;
        $self['productCart'] = $productCart;

        null !== $allowedPaymentMethodTypes && $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $self['billingCurrency'] = $billingCurrency;
        null !== $discountCode && $self['discountCode'] = $discountCode;
        null !== $force3DS && $self['force3DS'] = $force3DS;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $paymentMethodID && $self['paymentMethodID'] = $paymentMethodID;
        null !== $redirectImmediately && $self['redirectImmediately'] = $redirectImmediately;
        null !== $returnURL && $self['returnURL'] = $returnURL;
        null !== $shortLink && $self['shortLink'] = $shortLink;
        null !== $showSavedPaymentMethods && $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * Billing address details for the payment.
     *
     * @param BillingAddress|BillingAddressShape $billing
     */
    public function withBilling(BillingAddress|array $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    /**
     * Customer information for the payment.
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
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @param list<OneTimeProductCartItemShape> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

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
     * Discount Code to apply to the transaction.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $self = clone $this;
        $self['discountCode'] = $discountCode;

        return $self;
    }

    /**
     * Override merchant default 3DS behaviour for this payment.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $self = clone $this;
        $self['force3DS'] = $force3DS;

        return $self;
    }

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
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
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * Optional payment method ID to use for this payment.
     * If provided, customer_id must also be provided.
     * The payment method will be validated for eligibility with the payment's currency.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * If true, redirects the customer immediately after payment completion
     * False by default.
     */
    public function withRedirectImmediately(bool $redirectImmediately): self
    {
        $self = clone $this;
        $self['redirectImmediately'] = $redirectImmediately;

        return $self;
    }

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * If true, returns a shortened payment link.
     * Defaults to false if not specified.
     */
    public function withShortLink(?bool $shortLink): self
    {
        $self = clone $this;
        $self['shortLink'] = $shortLink;

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
}
