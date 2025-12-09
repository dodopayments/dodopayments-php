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
 *   customer: AttachExistingCustomer|array{customer_id: string}|NewCustomer|array{
 *     email: string, name?: string|null, phone_number?: string|null
 *   },
 *   product_cart: list<OneTimeProductCartItem|array{
 *     product_id: string, quantity: int, amount?: int|null
 *   }>,
 *   allowed_payment_method_types?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billing_currency?: null|Currency|value-of<Currency>,
 *   discount_code?: string|null,
 *   force_3ds?: bool|null,
 *   metadata?: array<string,string>,
 *   payment_link?: bool|null,
 *   return_url?: string|null,
 *   show_saved_payment_methods?: bool,
 *   tax_id?: string|null,
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
     * @var list<OneTimeProductCartItem> $product_cart
     */
    #[Required(list: OneTimeProductCartItem::class)]
    public array $product_cart;

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @var list<value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     */
    #[Optional(list: PaymentMethodTypes::class, nullable: true)]
    public ?array $allowed_payment_method_types;

    /**
     * Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed.
     *
     * @var value-of<Currency>|null $billing_currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $billing_currency;

    /**
     * Discount Code to apply to the transaction.
     */
    #[Optional(nullable: true)]
    public ?string $discount_code;

    /**
     * Override merchant default 3DS behaviour for this payment.
     */
    #[Optional(nullable: true)]
    public ?bool $force_3ds;

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
    #[Optional(nullable: true)]
    public ?bool $payment_link;

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     */
    #[Optional(nullable: true)]
    public ?string $return_url;

    /**
     * Display saved payment methods of a returning customer
     * False by default.
     */
    #[Optional]
    public ?bool $show_saved_payment_methods;

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    #[Optional(nullable: true)]
    public ?string $tax_id;

    /**
     * `new PaymentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentCreateParams::with(billing: ..., customer: ..., product_cart: ...)
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
     * @param AttachExistingCustomer|array{customer_id: string}|NewCustomer|array{
     *   email: string, name?: string|null, phone_number?: string|null
     * } $customer
     * @param list<OneTimeProductCartItem|array{
     *   product_id: string, quantity: int, amount?: int|null
     * }> $product_cart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     * @param Currency|value-of<Currency>|null $billing_currency
     * @param array<string,string> $metadata
     */
    public static function with(
        BillingAddress|array $billing,
        AttachExistingCustomer|array|NewCustomer $customer,
        array $product_cart,
        ?array $allowed_payment_method_types = null,
        Currency|string|null $billing_currency = null,
        ?string $discount_code = null,
        ?bool $force_3ds = null,
        ?array $metadata = null,
        ?bool $payment_link = null,
        ?string $return_url = null,
        ?bool $show_saved_payment_methods = null,
        ?string $tax_id = null,
    ): self {
        $obj = new self;

        $obj['billing'] = $billing;
        $obj['customer'] = $customer;
        $obj['product_cart'] = $product_cart;

        null !== $allowed_payment_method_types && $obj['allowed_payment_method_types'] = $allowed_payment_method_types;
        null !== $billing_currency && $obj['billing_currency'] = $billing_currency;
        null !== $discount_code && $obj['discount_code'] = $discount_code;
        null !== $force_3ds && $obj['force_3ds'] = $force_3ds;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $payment_link && $obj['payment_link'] = $payment_link;
        null !== $return_url && $obj['return_url'] = $return_url;
        null !== $show_saved_payment_methods && $obj['show_saved_payment_methods'] = $show_saved_payment_methods;
        null !== $tax_id && $obj['tax_id'] = $tax_id;

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
     * @param AttachExistingCustomer|array{customer_id: string}|NewCustomer|array{
     *   email: string, name?: string|null, phone_number?: string|null
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
     *   product_id: string, quantity: int, amount?: int|null
     * }> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj['product_cart'] = $productCart;

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
     * Discount Code to apply to the transaction.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj['discount_code'] = $discountCode;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this payment.
     */
    public function withForce3DS(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj['force_3ds'] = $force3DS;

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
        $obj['payment_link'] = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj['return_url'] = $returnURL;

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
        $obj['show_saved_payment_methods'] = $showSavedPaymentMethods;

        return $obj;
    }

    /**
     * Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail.
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj['tax_id'] = $taxID;

        return $obj;
    }
}
