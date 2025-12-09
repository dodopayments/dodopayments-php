<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\PaymentsService::create()
 *
 * @phpstan-type PaymentCreateParamsShape = array{
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
 *   productCart: list<OneTimeProductCartItem|array{
 *     productID: string, quantity: int, amount?: int|null
 *   }>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   discountCode?: string|null,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>,
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
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
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
     * @param list<OneTimeProductCartItem|array{
     *   productID: string, quantity: int, amount?: int|null
     * }> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param array<string,string> $metadata
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
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
    ): self {
        $obj = new self;

        $obj['billing'] = $billing;
        $obj['customer'] = $customer;
        $obj['productCart'] = $productCart;

        null !== $allowedPaymentMethodTypes && $obj['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $obj['billingCurrency'] = $billingCurrency;
        null !== $discountCode && $obj['discountCode'] = $discountCode;
        null !== $force3DS && $obj['force3DS'] = $force3DS;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $paymentLink && $obj['paymentLink'] = $paymentLink;
        null !== $returnURL && $obj['returnURL'] = $returnURL;
        null !== $showSavedPaymentMethods && $obj['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $taxID && $obj['taxID'] = $taxID;

        return $obj;
    }

    /**
     * Billing address details for the payment.
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
     * Customer information for the payment.
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
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @param list<OneTimeProductCartItem|array{
     *   productID: string, quantity: int, amount?: int|null
     * }> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj['productCart'] = $productCart;

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
     * Discount Code to apply to the transaction.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj['discountCode'] = $discountCode;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this payment.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj['force3DS'] = $force3DS;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
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
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $obj = clone $this;
        $obj['paymentLink'] = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
}
