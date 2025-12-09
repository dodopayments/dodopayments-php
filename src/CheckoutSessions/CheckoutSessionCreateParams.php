<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\BillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\FeatureFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\SubscriptionData;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\OnDemandSubscription;

/**
 * @see Dodopayments\Services\CheckoutSessionsService::create()
 *
 * @phpstan-type CheckoutSessionCreateParamsShape = array{
 *   productCart: list<ProductCart|array{
 *     productID: string,
 *     quantity: int,
 *     addons?: list<AttachAddon>|null,
 *     amount?: int|null,
 *   }>,
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   billingAddress?: null|BillingAddress|array{
 *     country: value-of<CountryCode>,
 *     city?: string|null,
 *     state?: string|null,
 *     street?: string|null,
 *     zipcode?: string|null,
 *   },
 *   billingCurrency?: null|Currency|value-of<Currency>,
 *   confirm?: bool,
 *   customer?: null|AttachExistingCustomer|array{
 *     customerID: string
 *   }|NewCustomer|array{
 *     email: string, name?: string|null, phoneNumber?: string|null
 *   },
 *   customization?: Customization|array{
 *     forceLanguage?: string|null,
 *     showOnDemandTag?: bool|null,
 *     showOrderDetails?: bool|null,
 *     theme?: value-of<Theme>|null,
 *   },
 *   discountCode?: string|null,
 *   featureFlags?: FeatureFlags|array{
 *     allowCurrencySelection?: bool|null,
 *     allowCustomerEditingCity?: bool|null,
 *     allowCustomerEditingCountry?: bool|null,
 *     allowCustomerEditingEmail?: bool|null,
 *     allowCustomerEditingName?: bool|null,
 *     allowCustomerEditingState?: bool|null,
 *     allowCustomerEditingStreet?: bool|null,
 *     allowCustomerEditingZipcode?: bool|null,
 *     allowDiscountCode?: bool|null,
 *     allowPhoneNumberCollection?: bool|null,
 *     allowTaxID?: bool|null,
 *     alwaysCreateNewCustomer?: bool|null,
 *   },
 *   force3DS?: bool|null,
 *   metadata?: array<string,string>|null,
 *   minimalAddress?: bool,
 *   returnURL?: string|null,
 *   showSavedPaymentMethods?: bool,
 *   subscriptionData?: null|SubscriptionData|array{
 *     onDemand?: OnDemandSubscription|null, trialPeriodDays?: int|null
 *   },
 * }
 */
final class CheckoutSessionCreateParams implements BaseModel
{
    /** @use SdkModel<CheckoutSessionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * @param list<ProductCart|array{
     *   productID: string,
     *   quantity: int,
     *   addons?: list<AttachAddon>|null,
     *   amount?: int|null,
     * }> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billingAddress
     * @param Currency|value-of<Currency>|null $billingCurrency
     * @param AttachExistingCustomer|array{customerID: string}|NewCustomer|array{
     *   email: string, name?: string|null, phoneNumber?: string|null
     * }|null $customer
     * @param Customization|array{
     *   forceLanguage?: string|null,
     *   showOnDemandTag?: bool|null,
     *   showOrderDetails?: bool|null,
     *   theme?: value-of<Theme>|null,
     * } $customization
     * @param FeatureFlags|array{
     *   allowCurrencySelection?: bool|null,
     *   allowCustomerEditingCity?: bool|null,
     *   allowCustomerEditingCountry?: bool|null,
     *   allowCustomerEditingEmail?: bool|null,
     *   allowCustomerEditingName?: bool|null,
     *   allowCustomerEditingState?: bool|null,
     *   allowCustomerEditingStreet?: bool|null,
     *   allowCustomerEditingZipcode?: bool|null,
     *   allowDiscountCode?: bool|null,
     *   allowPhoneNumberCollection?: bool|null,
     *   allowTaxID?: bool|null,
     *   alwaysCreateNewCustomer?: bool|null,
     * } $featureFlags
     * @param array<string,string>|null $metadata
     * @param SubscriptionData|array{
     *   onDemand?: OnDemandSubscription|null, trialPeriodDays?: int|null
     * }|null $subscriptionData
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
        $obj = new self;

        $obj['productCart'] = $productCart;

        null !== $allowedPaymentMethodTypes && $obj['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $billingAddress && $obj['billingAddress'] = $billingAddress;
        null !== $billingCurrency && $obj['billingCurrency'] = $billingCurrency;
        null !== $confirm && $obj['confirm'] = $confirm;
        null !== $customer && $obj['customer'] = $customer;
        null !== $customization && $obj['customization'] = $customization;
        null !== $discountCode && $obj['discountCode'] = $discountCode;
        null !== $featureFlags && $obj['featureFlags'] = $featureFlags;
        null !== $force3DS && $obj['force3DS'] = $force3DS;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $minimalAddress && $obj['minimalAddress'] = $minimalAddress;
        null !== $returnURL && $obj['returnURL'] = $returnURL;
        null !== $showSavedPaymentMethods && $obj['showSavedPaymentMethods'] = $showSavedPaymentMethods;
        null !== $subscriptionData && $obj['subscriptionData'] = $subscriptionData;

        return $obj;
    }

    /**
     * @param list<ProductCart|array{
     *   productID: string,
     *   quantity: int,
     *   addons?: list<AttachAddon>|null,
     *   amount?: int|null,
     * }> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $obj = clone $this;
        $obj['productCart'] = $productCart;

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
        $obj['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;

        return $obj;
    }

    /**
     * Billing address information for the session.
     *
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array|null $billingAddress
    ): self {
        $obj = clone $this;
        $obj['billingAddress'] = $billingAddress;

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
        $obj['billingCurrency'] = $billingCurrency;

        return $obj;
    }

    /**
     * If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     */
    public function withConfirm(bool $confirm): self
    {
        $obj = clone $this;
        $obj['confirm'] = $confirm;

        return $obj;
    }

    /**
     * Customer details for the session.
     *
     * @param AttachExistingCustomer|array{customerID: string}|NewCustomer|array{
     *   email: string, name?: string|null, phoneNumber?: string|null
     * }|null $customer
     */
    public function withCustomer(
        AttachExistingCustomer|array|NewCustomer|null $customer
    ): self {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * Customization for the checkout session page.
     *
     * @param Customization|array{
     *   forceLanguage?: string|null,
     *   showOnDemandTag?: bool|null,
     *   showOrderDetails?: bool|null,
     *   theme?: value-of<Theme>|null,
     * } $customization
     */
    public function withCustomization(Customization|array $customization): self
    {
        $obj = clone $this;
        $obj['customization'] = $customization;

        return $obj;
    }

    public function withDiscountCode(?string $discountCode): self
    {
        $obj = clone $this;
        $obj['discountCode'] = $discountCode;

        return $obj;
    }

    /**
     * @param FeatureFlags|array{
     *   allowCurrencySelection?: bool|null,
     *   allowCustomerEditingCity?: bool|null,
     *   allowCustomerEditingCountry?: bool|null,
     *   allowCustomerEditingEmail?: bool|null,
     *   allowCustomerEditingName?: bool|null,
     *   allowCustomerEditingState?: bool|null,
     *   allowCustomerEditingStreet?: bool|null,
     *   allowCustomerEditingZipcode?: bool|null,
     *   allowDiscountCode?: bool|null,
     *   allowPhoneNumberCollection?: bool|null,
     *   allowTaxID?: bool|null,
     *   alwaysCreateNewCustomer?: bool|null,
     * } $featureFlags
     */
    public function withFeatureFlags(FeatureFlags|array $featureFlags): self
    {
        $obj = clone $this;
        $obj['featureFlags'] = $featureFlags;

        return $obj;
    }

    /**
     * Override merchant default 3DS behaviour for this session.
     */
    public function withForce3Ds(?bool $force3DS): self
    {
        $obj = clone $this;
        $obj['force3DS'] = $force3DS;

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
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * If true, only zipcode is required when confirm is true; other address fields remain optional.
     */
    public function withMinimalAddress(bool $minimalAddress): self
    {
        $obj = clone $this;
        $obj['minimalAddress'] = $minimalAddress;

        return $obj;
    }

    /**
     * The url to redirect after payment failure or success.
     */
    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj['returnURL'] = $returnURL;

        return $obj;
    }

    /**
     * Display saved payment methods of a returning customer False by default.
     */
    public function withShowSavedPaymentMethods(
        bool $showSavedPaymentMethods
    ): self {
        $obj = clone $this;
        $obj['showSavedPaymentMethods'] = $showSavedPaymentMethods;

        return $obj;
    }

    /**
     * @param SubscriptionData|array{
     *   onDemand?: OnDemandSubscription|null, trialPeriodDays?: int|null
     * }|null $subscriptionData
     */
    public function withSubscriptionData(
        SubscriptionData|array|null $subscriptionData
    ): self {
        $obj = clone $this;
        $obj['subscriptionData'] = $subscriptionData;

        return $obj;
    }
}
