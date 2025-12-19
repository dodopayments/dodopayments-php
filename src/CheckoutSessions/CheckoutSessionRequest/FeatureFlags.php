<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FeatureFlagsShape = array{
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
 *   redirectImmediately?: bool|null,
 * }
 */
final class FeatureFlags implements BaseModel
{
    /** @use SdkModel<FeatureFlagsShape> */
    use SdkModel;

    /**
     * if customer is allowed to change currency, set it to true.
     *
     * Default is true
     */
    #[Optional('allow_currency_selection')]
    public ?bool $allowCurrencySelection;

    #[Optional('allow_customer_editing_city')]
    public ?bool $allowCustomerEditingCity;

    #[Optional('allow_customer_editing_country')]
    public ?bool $allowCustomerEditingCountry;

    #[Optional('allow_customer_editing_email')]
    public ?bool $allowCustomerEditingEmail;

    #[Optional('allow_customer_editing_name')]
    public ?bool $allowCustomerEditingName;

    #[Optional('allow_customer_editing_state')]
    public ?bool $allowCustomerEditingState;

    #[Optional('allow_customer_editing_street')]
    public ?bool $allowCustomerEditingStreet;

    #[Optional('allow_customer_editing_zipcode')]
    public ?bool $allowCustomerEditingZipcode;

    /**
     * If the customer is allowed to apply discount code, set it to true.
     *
     * Default is true
     */
    #[Optional('allow_discount_code')]
    public ?bool $allowDiscountCode;

    /**
     * If phone number is collected from customer, set it to rue.
     *
     * Default is true
     */
    #[Optional('allow_phone_number_collection')]
    public ?bool $allowPhoneNumberCollection;

    /**
     * If the customer is allowed to add tax id, set it to true.
     *
     * Default is true
     */
    #[Optional('allow_tax_id')]
    public ?bool $allowTaxID;

    /**
     * Set to true if a new customer object should be created.
     * By default email is used to find an existing customer to attach the session to.
     *
     * Default is false
     */
    #[Optional('always_create_new_customer')]
    public ?bool $alwaysCreateNewCustomer;

    /**
     * If true, redirects the customer immediately after payment completion.
     *
     * Default is false
     */
    #[Optional('redirect_immediately')]
    public ?bool $redirectImmediately;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $allowCurrencySelection = null,
        ?bool $allowCustomerEditingCity = null,
        ?bool $allowCustomerEditingCountry = null,
        ?bool $allowCustomerEditingEmail = null,
        ?bool $allowCustomerEditingName = null,
        ?bool $allowCustomerEditingState = null,
        ?bool $allowCustomerEditingStreet = null,
        ?bool $allowCustomerEditingZipcode = null,
        ?bool $allowDiscountCode = null,
        ?bool $allowPhoneNumberCollection = null,
        ?bool $allowTaxID = null,
        ?bool $alwaysCreateNewCustomer = null,
        ?bool $redirectImmediately = null,
    ): self {
        $self = new self;

        null !== $allowCurrencySelection && $self['allowCurrencySelection'] = $allowCurrencySelection;
        null !== $allowCustomerEditingCity && $self['allowCustomerEditingCity'] = $allowCustomerEditingCity;
        null !== $allowCustomerEditingCountry && $self['allowCustomerEditingCountry'] = $allowCustomerEditingCountry;
        null !== $allowCustomerEditingEmail && $self['allowCustomerEditingEmail'] = $allowCustomerEditingEmail;
        null !== $allowCustomerEditingName && $self['allowCustomerEditingName'] = $allowCustomerEditingName;
        null !== $allowCustomerEditingState && $self['allowCustomerEditingState'] = $allowCustomerEditingState;
        null !== $allowCustomerEditingStreet && $self['allowCustomerEditingStreet'] = $allowCustomerEditingStreet;
        null !== $allowCustomerEditingZipcode && $self['allowCustomerEditingZipcode'] = $allowCustomerEditingZipcode;
        null !== $allowDiscountCode && $self['allowDiscountCode'] = $allowDiscountCode;
        null !== $allowPhoneNumberCollection && $self['allowPhoneNumberCollection'] = $allowPhoneNumberCollection;
        null !== $allowTaxID && $self['allowTaxID'] = $allowTaxID;
        null !== $alwaysCreateNewCustomer && $self['alwaysCreateNewCustomer'] = $alwaysCreateNewCustomer;
        null !== $redirectImmediately && $self['redirectImmediately'] = $redirectImmediately;

        return $self;
    }

    /**
     * if customer is allowed to change currency, set it to true.
     *
     * Default is true
     */
    public function withAllowCurrencySelection(
        bool $allowCurrencySelection
    ): self {
        $self = clone $this;
        $self['allowCurrencySelection'] = $allowCurrencySelection;

        return $self;
    }

    public function withAllowCustomerEditingCity(
        bool $allowCustomerEditingCity
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingCity'] = $allowCustomerEditingCity;

        return $self;
    }

    public function withAllowCustomerEditingCountry(
        bool $allowCustomerEditingCountry
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingCountry'] = $allowCustomerEditingCountry;

        return $self;
    }

    public function withAllowCustomerEditingEmail(
        bool $allowCustomerEditingEmail
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingEmail'] = $allowCustomerEditingEmail;

        return $self;
    }

    public function withAllowCustomerEditingName(
        bool $allowCustomerEditingName
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingName'] = $allowCustomerEditingName;

        return $self;
    }

    public function withAllowCustomerEditingState(
        bool $allowCustomerEditingState
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingState'] = $allowCustomerEditingState;

        return $self;
    }

    public function withAllowCustomerEditingStreet(
        bool $allowCustomerEditingStreet
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingStreet'] = $allowCustomerEditingStreet;

        return $self;
    }

    public function withAllowCustomerEditingZipcode(
        bool $allowCustomerEditingZipcode
    ): self {
        $self = clone $this;
        $self['allowCustomerEditingZipcode'] = $allowCustomerEditingZipcode;

        return $self;
    }

    /**
     * If the customer is allowed to apply discount code, set it to true.
     *
     * Default is true
     */
    public function withAllowDiscountCode(bool $allowDiscountCode): self
    {
        $self = clone $this;
        $self['allowDiscountCode'] = $allowDiscountCode;

        return $self;
    }

    /**
     * If phone number is collected from customer, set it to rue.
     *
     * Default is true
     */
    public function withAllowPhoneNumberCollection(
        bool $allowPhoneNumberCollection
    ): self {
        $self = clone $this;
        $self['allowPhoneNumberCollection'] = $allowPhoneNumberCollection;

        return $self;
    }

    /**
     * If the customer is allowed to add tax id, set it to true.
     *
     * Default is true
     */
    public function withAllowTaxID(bool $allowTaxID): self
    {
        $self = clone $this;
        $self['allowTaxID'] = $allowTaxID;

        return $self;
    }

    /**
     * Set to true if a new customer object should be created.
     * By default email is used to find an existing customer to attach the session to.
     *
     * Default is false
     */
    public function withAlwaysCreateNewCustomer(
        bool $alwaysCreateNewCustomer
    ): self {
        $self = clone $this;
        $self['alwaysCreateNewCustomer'] = $alwaysCreateNewCustomer;

        return $self;
    }

    /**
     * If true, redirects the customer immediately after payment completion.
     *
     * Default is false
     */
    public function withRedirectImmediately(bool $redirectImmediately): self
    {
        $self = clone $this;
        $self['redirectImmediately'] = $redirectImmediately;

        return $self;
    }
}
