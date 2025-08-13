<?php

declare(strict_types=1);

namespace DodoPayments\Payments;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Misc\Currency;

/**
 * @phpstan-type create_params = array{
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
    use Model;
    use Params;

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
    #[Api('product_cart', type: new ListOf(OneTimeProductCartItem::class))]
    public array $productCart;

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
     * Discount Code to apply to the transaction.
     */
    #[Api('discount_code', optional: true)]
    public ?string $discountCode;

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $metadata;

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    #[Api('payment_link', optional: true)]
    public ?bool $paymentLink;

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
     * @param list<OneTimeProductCartItem> $productCart
     * @param null|list<PaymentMethodTypes::*> $allowedPaymentMethodTypes
     * @param Currency::* $billingCurrency
     * @param null|array<string, string> $metadata
     */
    public static function from(
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
    public function setBilling(BillingAddress $billing): self
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * Customer information for the payment.
     */
    public function setCustomer(
        AttachExistingCustomer|NewCustomer $customer
    ): self {
        $this->customer = $customer;

        return $this;
    }

    /**
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     *
     * @param list<OneTimeProductCartItem> $productCart
     */
    public function setProductCart(array $productCart): self
    {
        $this->productCart = $productCart;

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
     * Discount Code to apply to the transaction.
     */
    public function setDiscountCode(?string $discountCode): self
    {
        $this->discountCode = $discountCode;

        return $this;
    }

    /**
     * Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    public function setPaymentLink(?bool $paymentLink): self
    {
        $this->paymentLink = $paymentLink;

        return $this;
    }

    /**
     * Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
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
}
