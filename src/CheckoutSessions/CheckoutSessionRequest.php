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

final class CheckoutSessionRequest implements BaseModel
{
    use SdkModel;

    /** @var list<ProductCart> $productCart */
    #[Api('product_cart', list: ProductCart::class)]
    public array $productCart;

    /**
     * Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
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
     * Billing address information for the session.
     */
    #[Api('billing_address', nullable: true, optional: true)]
    public ?BillingAddress $billingAddress;

    /**
     * This field is ingored if adaptive pricing is disabled.
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

    #[Api('discount_code', nullable: true, optional: true)]
    public ?string $discountCode;

    #[Api('feature_flags', optional: true)]
    public ?FeatureFlags $featureFlags;

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * The url to redirect after payment failure or success.
     */
    #[Api('return_url', nullable: true, optional: true)]
    public ?string $returnURL;

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    #[Api('show_saved_payment_methods', optional: true)]
    public ?bool $showSavedPaymentMethods;

    #[Api('subscription_data', nullable: true, optional: true)]
    public ?SubscriptionData $subscriptionData;

    /**
     * `new CheckoutSessionRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionRequest::with(productCart: ...)
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ProductCart> $productCart
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes
     * @param Currency::* $billingCurrency
     * @param array<string, string>|null $metadata
     */
    public static function with(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        ?BillingAddress $billingAddress = null,
        ?string $billingCurrency = null,
        ?bool $confirm = null,
        AttachExistingCustomer|NewCustomer|null $customer = null,
        ?Customization $customization = null,
        ?string $discountCode = null,
        ?FeatureFlags $featureFlags = null,
        ?array $metadata = null,
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        ?SubscriptionData $subscriptionData = null,
    ): self {
        $obj = new self;

        $obj->productCart = $productCart;

        null !== $allowedPaymentMethodTypes && $obj->allowedPaymentMethodTypes = $allowedPaymentMethodTypes;
        null !== $billingAddress && $obj->billingAddress = $billingAddress;
        null !== $billingCurrency && $obj->billingCurrency = $billingCurrency;
        null !== $confirm && $obj->confirm = $confirm;
        null !== $customer && $obj->customer = $customer;
        null !== $customization && $obj->customization = $customization;
        null !== $discountCode && $obj->discountCode = $discountCode;
        null !== $featureFlags && $obj->featureFlags = $featureFlags;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $returnURL && $obj->returnURL = $returnURL;
        null !== $showSavedPaymentMethods && $obj->showSavedPaymentMethods = $showSavedPaymentMethods;
        null !== $subscriptionData && $obj->subscriptionData = $subscriptionData;

        return $obj;
    }

    /**
     * @param list<ProductCart> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj->productCart = $productCart;

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
     * Billing address information for the session.
     */
    public function withBillingAddress(?BillingAddress $billingAddress): self
    {
        $obj = clone $this;
        $obj->billingAddress = $billingAddress;

        return $obj;
    }

    /**
     * This field is ingored if adaptive pricing is disabled.
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
        AttachExistingCustomer|NewCustomer $customer
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
        $obj->discountCode = $discountCode;

        return $obj;
    }

    public function withFeatureFlags(FeatureFlags $featureFlags): self
    {
        $obj = clone $this;
        $obj->featureFlags = $featureFlags;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @param array<string, string>|null $metadata
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
        $obj->returnURL = $returnURL;

        return $obj;
    }

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $obj = clone $this;
        $obj->showSavedPaymentMethods = $showSavedPaymentMethods;

        return $obj;
    }

    public function withSubscriptionData(
        ?SubscriptionData $subscriptionData
    ): self {
        $obj = clone $this;
        $obj->subscriptionData = $subscriptionData;

        return $obj;
    }
}
