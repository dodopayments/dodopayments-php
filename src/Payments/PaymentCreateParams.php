<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Payments->create
 *
 * @phpstan-type payment_create_params = array{
 *   billing: BillingAddress,
 *   customer: AttachExistingCustomer|NewCustomer,
 *   productCart: list<OneTimeProductCartItem>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes::*>|null,
 *   billingCurrency?: Currency::*,
 *   discountCode?: string|null,
 *   metadata?: array<string, string>,
 *   paymentLink?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
 *   taxID?: string|null,
 * }
 */
final class PaymentCreateParams implements BaseModel
{
    /** @use SdkModel<payment_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Billing address details for the payment.
     */
    #[Api]
    public BillingAddress $billing;

    /**
     * Customer information for the payment.
     */
    #[Api]
    public AttachExistingCustomer|NewCustomer $customer;

    /**
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @var list<OneTimeProductCartItem> $productCart
     */
    #[Api('product_cart', list: OneTimeProductCartItem::class)]
    public array $productCart;

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
     * Discount Code to apply to the transaction.
     */
    #[Api('discount_code', nullable: true, optional: true)]
    public ?string $discountCode;

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    #[Api('payment_link', nullable: true, optional: true)]
    public ?bool $paymentLink;

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
     * @param list<OneTimeProductCartItem> $productCart
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes
     * @param Currency::* $billingCurrency
     * @param array<string, string> $metadata
     */
    public static function with(
        BillingAddress $billing,
        AttachExistingCustomer|NewCustomer $customer,
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        ?string $billingCurrency = null,
        ?string $discountCode = null,
        ?array $metadata = null,
        ?bool $paymentLink = null,
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
    ): self {
        $obj = new self;

        $obj->billing = $billing;
        $obj->customer = $customer;
        $obj->productCart = $productCart;

        null !== $allowedPaymentMethodTypes && $obj->allowedPaymentMethodTypes = $allowedPaymentMethodTypes;
        null !== $billingCurrency && $obj->billingCurrency = $billingCurrency;
        null !== $discountCode && $obj->discountCode = $discountCode;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;
        null !== $returnURL && $obj->returnURL = $returnURL;
        null !== $showSavedPaymentMethods && $obj->showSavedPaymentMethods = $showSavedPaymentMethods;
        null !== $taxID && $obj->taxID = $taxID;

        return $obj;
    }

    /**
     * Billing address details for the payment.
     */
    public function withBilling(BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * Customer information for the payment.
     */
    public function withCustomer(
        AttachExistingCustomer|NewCustomer $customer
    ): self {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @param list<OneTimeProductCartItem> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj->productCart = $productCart;

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
     * Discount Code to apply to the transaction.
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj->discountCode = $discountCode;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    public function withPaymentLink(?bool $paymentLink): self
    {
        $obj = clone $this;
        $obj->paymentLink = $paymentLink;

        return $obj;
    }

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
}
