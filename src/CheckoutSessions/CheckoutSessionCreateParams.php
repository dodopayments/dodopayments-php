<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @see Dodopayments\Services\CheckoutSessionsService::create()
 *
 * @phpstan-import-type CustomerRequestVariants from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type ProductItemReqShape from \Dodopayments\CheckoutSessions\ProductItemReq
 * @phpstan-import-type CheckoutSessionBillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionBillingAddress
 * @phpstan-import-type CustomFieldShape from \Dodopayments\CheckoutSessions\CustomField
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type CheckoutSessionCustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionCustomization
 * @phpstan-import-type CheckoutSessionFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionFlags
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\SubscriptionData
 *
 * @phpstan-type CheckoutSessionCreateParamsShape = array{
 *   productCart: list<ProductItemReq|ProductItemReqShape>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingAddress?: null|CheckoutSessionBillingAddress|CheckoutSessionBillingAddressShape,
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   confirm?: bool|null,
 *   customFields?: list<CustomField|CustomFieldShape>|null,
 *   customer?: CustomerRequestShape|null,
 *   customization?: null|CheckoutSessionCustomization|CheckoutSessionCustomizationShape,
 *   discountCode?: string|null,
 *   featureFlags?: null|CheckoutSessionFlags|CheckoutSessionFlagsShape,
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>|null,
 *   minimalAddress?: bool|null,
 *   paymentMethodID?: string|null,
 *   productCollectionID?: string|null,
 *   returnURL?: string|null,
 *   shortLink?: bool|null,
 *   showSavedPaymentMethods?: bool|null,
 *   subscriptionData?: null|SubscriptionData|SubscriptionDataShape,
 * }
 */
final class CheckoutSessionCreateParams implements BaseModel
{
    /** @use SdkModel<CheckoutSessionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<ProductItemReq> $productCart */
    #[Required('product_cart', list: ProductItemReq::class)]
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
    public ?CheckoutSessionBillingAddress $billingAddress;

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
     * Custom fields to collect from customer during checkout (max 5 fields).
     *
     * @var list<CustomField>|null $customFields
     */
    #[Optional('custom_fields', list: CustomField::class, nullable: true)]
    public ?array $customFields;

    /**
     * Customer details for the session.
     *
     * @var CustomerRequestVariants|null $customer
     */
    #[Optional(nullable: true)]
    public AttachExistingCustomer|NewCustomer|null $customer;

    /**
     * Customization for the checkout session page.
     */
    #[Optional]
    public ?CheckoutSessionCustomization $customization;

    #[Optional('discount_code', nullable: true)]
    public ?string $discountCode;

    #[Optional('feature_flags')]
    public ?CheckoutSessionFlags $featureFlags;

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
     * Optional payment method ID to use for this checkout session.
     * Only allowed when `confirm` is true.
     * If provided, existing customer id must also be provided.
     */
    #[Optional('payment_method_id', nullable: true)]
    public ?string $paymentMethodID;

    /**
     * Product collection ID for collection-based checkout flow.
     */
    #[Optional('product_collection_id', nullable: true)]
    public ?string $productCollectionID;

    /**
     * The url to redirect after payment failure or success.
     */
    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    /**
     * If true, returns a shortened checkout URL.
     * Defaults to false if not specified.
     */
    #[Optional('short_link')]
    public ?bool $shortLink;

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    #[Optional('show_saved_payment_methods')]
    public ?bool $showSavedPaymentMethods;

    #[Optional('subscription_data', nullable: true)]
    public ?SubscriptionData $subscriptionData;

    /**
     * `new CheckoutSessionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionCreateParams::with(productCart: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionCreateParams)->withProductCart(...)
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
     * @param list<ProductItemReq|ProductItemReqShape> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param CheckoutSessionBillingAddress|CheckoutSessionBillingAddressShape|null $billingAddress
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param list<CustomField|CustomFieldShape>|null $customFields
     * @param CustomerRequestShape|null $customer
     * @param CheckoutSessionCustomization|CheckoutSessionCustomizationShape|null $customization
     * @param CheckoutSessionFlags|CheckoutSessionFlagsShape|null $featureFlags
     * @param array<string,string>|null $metadata
     * @param SubscriptionData|SubscriptionDataShape|null $subscriptionData
     */
    public static function with(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        CheckoutSessionBillingAddress|array|null $billingAddress = null,
        Currency|string|null $billingCurrency = null,
        ?bool $confirm = null,
        ?array $customFields = null,
        AttachExistingCustomer|array|NewCustomer|null $customer = null,
        CheckoutSessionCustomization|array|null $customization = null,
        ?string $discountCode = null,
        CheckoutSessionFlags|array|null $featureFlags = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $minimalAddress = null,
        ?string $paymentMethodID = null,
        ?string $productCollectionID = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        SubscriptionData|array|null $subscriptionData = null,
    ): self {
        $self = new self;

        $self['productCart'] = $productCart;

        null !== $allowedPaymentMethodTypes && $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $billingCurrency && $self['billingCurrency'] = $billingCurrency;
        null !== $confirm && $self['confirm'] = $confirm;
        null !== $customFields && $self['customFields'] = $customFields;
        null !== $customer && $self['customer'] = $customer;
        null !== $customization && $self['customization'] = $customization;
        null !== $discountCode && $self['discountCode'] = $discountCode;
        null !== $featureFlags && $self['featureFlags'] = $featureFlags;
        null !== $force3DS && $self['force3DS'] = $force3DS;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $minimalAddress && $self['minimalAddress'] = $minimalAddress;
        null !== $paymentMethodID && $self['paymentMethodID'] = $paymentMethodID;
        null !== $productCollectionID && $self['productCollectionID'] = $productCollectionID;
        null !== $returnURL && $self['returnURL'] = $returnURL;
        null !== $shortLink && $self['shortLink'] = $shortLink;
        null !== $showSavedPaymentMethods && $self['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $subscriptionData && $self['subscriptionData'] = $subscriptionData;

        return $self;
    }

    /**
     * @param list<ProductItemReq|ProductItemReqShape> $productCart
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
     * @param CheckoutSessionBillingAddress|CheckoutSessionBillingAddressShape|null $billingAddress
     */
    public function withBillingAddress(
        CheckoutSessionBillingAddress|array|null $billingAddress
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
     * Custom fields to collect from customer during checkout (max 5 fields).
     *
     * @param list<CustomField|CustomFieldShape>|null $customFields
     */
    public function withCustomFields(?array $customFields): self
    {
        $self = clone $this;
        $self['customFields'] = $customFields;

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
     * @param CheckoutSessionCustomization|CheckoutSessionCustomizationShape $customization
     */
    public function withCustomization(
        CheckoutSessionCustomization|array $customization
    ): self {
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
     * @param CheckoutSessionFlags|CheckoutSessionFlagsShape $featureFlags
     */
    public function withFeatureFlags(
        CheckoutSessionFlags|array $featureFlags
    ): self {
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
     * Optional payment method ID to use for this checkout session.
     * Only allowed when `confirm` is true.
     * If provided, existing customer id must also be provided.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * Product collection ID for collection-based checkout flow.
     */
    public function withProductCollectionID(?string $productCollectionID): self
    {
        $self = clone $this;
        $self['productCollectionID'] = $productCollectionID;

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
     * If true, returns a shortened checkout URL.
     * Defaults to false if not specified.
     */
    public function withShortLink(bool $shortLink): self
    {
        $self = clone $this;
        $self['shortLink'] = $shortLink;

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
