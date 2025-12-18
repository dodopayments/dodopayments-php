<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CheckoutSessionRequest\BillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\FeatureFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionRequest\SubscriptionData;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-import-type ProductCartShape from \Dodopayments\CheckoutSessions\CheckoutSessionRequest\ProductCart
 * @phpstan-import-type BillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionRequest\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type CustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization
 * @phpstan-import-type FeatureFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionRequest\FeatureFlags
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\CheckoutSessionRequest\SubscriptionData
 *
 * @phpstan-type CheckoutSessionRequestShape = array{
 *   productCart: list<ProductCartShape>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   confirm?: bool|null,
 *   customer?: CustomerRequestShape|null,
 *   customization?: null|Customization|CustomizationShape,
 *   discountCode?: string|null,
 *   featureFlags?: null|FeatureFlags|FeatureFlagsShape,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>|null,
 *   minimalAddress?: bool|null,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool|null,
 *   subscriptionData?: null|SubscriptionData|SubscriptionDataShape,
 * }
 */
final class CheckoutSessionRequest implements BaseModel
{
    /** @use SdkModel<CheckoutSessionRequestShape> */
    use SdkModel;

    /** @var list<ProductCart> $productCart */
    #[Required('product_cart', list: ProductCart::class)]
    public array $productCart;

    /**
     * Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
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
     * Billing address information for the session.
     */
    #[Optional('billing_address', nullable: true)]
    public ?BillingAddress $billingAddress;

    /**
     * This field is ingored if adaptive pricing is disabled.
     *
     * @var value-of<Currency>|null $billingCurrency
     */
    #[Optional('billing_currency', enum: Currency::class, nullable: true)]
    public ?string $billingCurrency;

    /**
     * If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     */
    #[Optional]
    public ?bool $confirm;

    /**
     * Customer details for the session.
     */
    #[Optional(nullable: true)]
    public AttachExistingCustomer|NewCustomer|null $customer;

    /**
     * Customization for the checkout session page.
     */
    #[Optional]
    public ?Customization $customization;

    #[Optional('discount_code', nullable: true)]
    public ?string $discountCode;

    #[Optional('feature_flags')]
    public ?FeatureFlags $featureFlags;

    /**
     * Override merchant default 3DS behaviour for this session.
     */
    #[Optional('force_3ds', nullable: true)]
    public ?bool $force3DS;

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    /**
     * If true, only zipcode is required when confirm is true; other address fields remain optional.
     */
    #[Optional('minimal_address')]
    public ?bool $minimalAddress;

    /**
     * The url to redirect after payment failure or success.
     */
    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    #[Optional('show_saved_payment_methods')]
    public ?bool $showSavedPaymentMethods;

    #[Optional('subscription_data', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ProductCartShape> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param CustomerRequestShape|null $customer
     * @param Customization|CustomizationShape|null $customization
     * @param FeatureFlags|FeatureFlagsShape|null $featureFlags
     * @param array<string,string>|null $metadata
     * @param SubscriptionData|SubscriptionDataShape|null $subscriptionData
     */
    public static function with(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        BillingAddress|array|null $billingAddress = null,
        Currency|string|null $billingCurrency = null,
        ?bool $confirm = null,
        AttachExistingCustomer|array|NewCustomer|null $customer = null,
        Customization|array|null $customization = null,
        ?string $discountCode = null,
        FeatureFlags|array|null $featureFlags = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $minimalAddress = null,
        ?string $returnURL = null,
        ?bool $showSavedPaymentMethods = null,
        SubscriptionData|array|null $subscriptionData = null,
    ): self {
        $self = new self;

        $self['productCart'] = $productCart;

        null !== $allowedPaymentMethodTypes && $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $billingCurrency && $self['billingCurrency'] = $billingCurrency;
        null !== $confirm && $self['confirm'] = $confirm;
        null !== $customer && $self['customer'] = $customer;
        null !== $customization && $self['customization'] = $customization;
        null !== $discountCode && $self['discountCode'] = $discountCode;
        null !== $featureFlags && $self['featureFlags'] = $featureFlags;
        null !== $force3DS && $self['force3DS'] = $force3DS;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $minimalAddress && $self['minimalAddress'] = $minimalAddress;
        null !== $returnURL && $self['returnURL'] = $returnURL;
        null !== $showSavedPaymentMethods && $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $subscriptionData && $self['subscriptionData'] = $subscriptionData;

        return $self;
    }

    /**
     * @param list<ProductCartShape> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

        return $self;
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
        $self = clone $this;
        $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;

        return $self;
    }

    /**
     * Billing address information for the session.
     *
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array|null $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * This field is ingored if adaptive pricing is disabled.
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
     * If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     */
    public function withConfirm(bool $confirm): self
    {
        $self = clone $this;
        $self['confirm'] = $confirm;

        return $self;
    }

    /**
     * Customer details for the session.
     *
     * @param CustomerRequestShape|null $customer
     */
    public function withCustomer(
        AttachExistingCustomer|array|NewCustomer|null $customer
    ): self {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Customization for the checkout session page.
     *
     * @param Customization|CustomizationShape $customization
     */
    public function withCustomization(Customization|array $customization): self
    {
        $self = clone $this;
        $self['customization'] = $customization;

        return $self;
    }

    public function withDiscountCode(?string $discountCode): self
    {
        $self = clone $this;
        $self['discountCode'] = $discountCode;

        return $self;
    }

    /**
     * @param FeatureFlags|FeatureFlagsShape $featureFlags
     */
    public function withFeatureFlags(FeatureFlags|array $featureFlags): self
    {
        $self = clone $this;
        $self['featureFlags'] = $featureFlags;

        return $self;
    }

    /**
     * Override merchant default 3DS behaviour for this session.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $self = clone $this;
        $self['force3DS'] = $force3DS;

        return $self;
    }

    /**
     * Additional metadata associated with the payment. Defaults to empty if not provided.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * If true, only zipcode is required when confirm is true; other address fields remain optional.
     */
    public function withMinimalAddress(bool $minimalAddress): self
    {
        $self = clone $this;
        $self['minimalAddress'] = $minimalAddress;

        return $self;
    }

    /**
     * The url to redirect after payment failure or success.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $self = clone $this;
        $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;

        return $self;
    }

    /**
     * @param SubscriptionData|SubscriptionDataShape|null $subscriptionData
     */
    public function withSubscriptionData(
        SubscriptionData|array|null $subscriptionData
    ): self {
        $self = clone $this;
        $self['subscriptionData'] = $subscriptionData;

        return $self;
    }
}
