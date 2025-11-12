<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CheckoutSessionRequest\BillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\FeatureFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\SubscriptionData;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-type CheckoutSessionRequestShape = array{
 *   product_cart: list<ProductCart>,
 *   allowed_payment_method_types?: list<value-of<PaymentMethodTypes>>|null,
 *   billing_address?: BillingAddress|null,
 *   billing_currency?: value-of<Currency>|null,
 *   confirm?: bool|null,
 *   customer?: null|AttachExistingCustomer|NewCustomer,
 *   customization?: Customization|null,
 *   discount_code?: string|null,
 *   feature_flags?: FeatureFlags|null,
 *   force_3ds?: bool|null,
 *   metadata?: array<string,string>|null,
 *   return_url?: string|null,
 *   show_saved_payment_methods?: bool|null,
 *   subscription_data?: SubscriptionData|null,
 * }
 */
final class CheckoutSessionRequest implements BaseModel
{
    /** @use SdkModel<CheckoutSessionRequestShape> */
    use SdkModel;

    /** @var list<ProductCart> $product_cart */
    #[Api(list: ProductCart::class)]
    public array $product_cart;

    /**
     * Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     *
     * @var list<value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     */
    #[Api(list: PaymentMethodTypes::class, nullable: true, optional: true)]
    public ?array $allowed_payment_method_types;

    /**
     * Billing address information for the session.
     */
    #[Api(nullable: true, optional: true)]
    public ?BillingAddress $billing_address;

    /**
     * This field is ingored if adaptive pricing is disabled.
     *
     * @var value-of<Currency>|null $billing_currency
     */
    #[Api(enum: Currency::class, nullable: true, optional: true)]
    public ?string $billing_currency;

    /**
     * If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     */
    #[Api(optional: true)]
    public ?bool $confirm;

    /**
     * Customer details for the session.
     */
    #[Api(nullable: true, optional: true)]
    public AttachExistingCustomer|NewCustomer|null $customer;

    /**
     * Customization for the checkout session page.
     */
    #[Api(optional: true)]
    public ?Customization $customization;

    #[Api(nullable: true, optional: true)]
    public ?string $discount_code;

    #[Api(optional: true)]
    public ?FeatureFlags $feature_flags;

    /**
     * Override merchant default 3DS behaviour for this session.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $force_3ds;

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * The url to redirect after payment failure or success.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $return_url;

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    #[Api(optional: true)]
    public ?bool $show_saved_payment_methods;

    #[Api(nullable: true, optional: true)]
    public ?SubscriptionData $subscription_data;

    /**
     * `new CheckoutSessionRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionRequest::with(product_cart: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionRequest)->withProductCart(...)
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
     * @param list<ProductCart> $product_cart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowed_payment_method_types
     * @param Currency|value-of<Currency>|null $billing_currency
     * @param array<string,string>|null $metadata
     */
    public static function with(
        array $product_cart,
        ?array $allowed_payment_method_types = null,
        ?BillingAddress $billing_address = null,
        Currency|string|null $billing_currency = null,
        ?bool $confirm = null,
        AttachExistingCustomer|NewCustomer|null $customer = null,
        ?Customization $customization = null,
        ?string $discount_code = null,
        ?FeatureFlags $feature_flags = null,
        ?bool $force_3ds = null,
        ?array $metadata = null,
        ?string $return_url = null,
        ?bool $show_saved_payment_methods = null,
        ?SubscriptionData $subscription_data = null,
    ): self {
        $obj = new self;

        $obj->product_cart = $product_cart;

        null !== $allowed_payment_method_types && $obj['allowed_payment_method_types'] = $allowed_payment_method_types;
        null !== $billing_address && $obj->billing_address = $billing_address;
        null !== $billing_currency && $obj['billing_currency'] = $billing_currency;
        null !== $confirm && $obj->confirm = $confirm;
        null !== $customer && $obj->customer = $customer;
        null !== $customization && $obj->customization = $customization;
        null !== $discount_code && $obj->discount_code = $discount_code;
        null !== $feature_flags && $obj->feature_flags = $feature_flags;
        null !== $force_3ds && $obj->force_3ds = $force_3ds;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $return_url && $obj->return_url = $return_url;
        null !== $show_saved_payment_methods && $obj->show_saved_payment_methods = $show_saved_payment_methods;
        null !== $subscription_data && $obj->subscription_data = $subscription_data;

        return $obj;
    }

    /**
     * @param list<ProductCart> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj->product_cart = $productCart;

        return $obj;
    }

    /**
     * Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
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
     * Billing address information for the session.
     */
    public function withBillingAddress(?BillingAddress $billingAddress): self
    {
        $obj = clone $this;
        $obj->billing_address = $billingAddress;

        return $obj;
    }

    /**
     * This field is ingored if adaptive pricing is disabled.
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
     * If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     */
    public function withConfirm(bool $confirm): self
    {
        $obj = clone $this;
        $obj->confirm = $confirm;

        return $obj;
    }

    /**
     * Customer details for the session.
     */
    public function withCustomer(
        AttachExistingCustomer|NewCustomer|null $customer
    ): self {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Customization for the checkout session page.
     */
    public function withCustomization(Customization $customization): self
    {
        $obj = clone $this;
        $obj->customization = $customization;

        return $obj;
    }

    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj->discount_code = $discountCode;

        return $obj;
    }

    public function withFeatureFlags(FeatureFlags $featureFlags): self
    {
        $obj = clone $this;
        $obj->feature_flags = $featureFlags;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this session.
     */
    public function withForce3DS(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj->force_3ds = $force3DS;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * The url to redirect after payment failure or success.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj->return_url = $returnURL;

        return $obj;
    }

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $obj = clone $this;
        $obj->show_saved_payment_methods = $showSavedPaymentMethods;

        return $obj;
    }

    public function withSubscriptionData(
        ?SubscriptionData $subscriptionData
    ): self {
        $obj = clone $this;
        $obj->subscription_data = $subscriptionData;

        return $obj;
    }
}
