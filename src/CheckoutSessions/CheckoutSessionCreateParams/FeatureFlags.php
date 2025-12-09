<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

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
    ): self {
        $obj = new self;

        null !== $allowCurrencySelection && $obj['allowCurrencySelection'] = $allowCurrencySelection;
        null !== $allowCustomerEditingCity && $obj['allowCustomerEditingCity'] = $allowCustomerEditingCity;
        null !== $allowCustomerEditingCountry && $obj['allowCustomerEditingCountry'] = $allowCustomerEditingCountry;
        null !== $allowCustomerEditingEmail && $obj['allowCustomerEditingEmail'] = $allowCustomerEditingEmail;
        null !== $allowCustomerEditingName && $obj['allowCustomerEditingName'] = $allowCustomerEditingName;
        null !== $allowCustomerEditingState && $obj['allowCustomerEditingState'] = $allowCustomerEditingState;
        null !== $allowCustomerEditingStreet && $obj['allowCustomerEditingStreet'] = $allowCustomerEditingStreet;
        null !== $allowCustomerEditingZipcode && $obj['allowCustomerEditingZipcode'] = $allowCustomerEditingZipcode;
        null !== $allowDiscountCode && $obj['allowDiscountCode'] = $allowDiscountCode;
        null !== $allowPhoneNumberCollection && $obj['allowPhoneNumberCollection'] = $allowPhoneNumberCollection;
        null !== $allowTaxID && $obj['allowTaxID'] = $allowTaxID;
        null !== $alwaysCreateNewCustomer && $obj['alwaysCreateNewCustomer'] = $alwaysCreateNewCustomer;

        return $obj;
    }

    /**
     * if customer is allowed to change currency, set it to true.
     *
     * Default is true
     */
    public function withAllowCurrencySelection(
        bool $allowCurrencySelection
    ): self {
        $obj = clone $this;
        $obj['allowCurrencySelection'] = $allowCurrencySelection;

        return $obj;
    }

    public function withAllowCustomerEditingCity(
        bool $allowCustomerEditingCity
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingCity'] = $allowCustomerEditingCity;

        return $obj;
    }

    public function withAllowCustomerEditingCountry(
        bool $allowCustomerEditingCountry
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingCountry'] = $allowCustomerEditingCountry;

        return $obj;
    }

    public function withAllowCustomerEditingEmail(
        bool $allowCustomerEditingEmail
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingEmail'] = $allowCustomerEditingEmail;

        return $obj;
    }

    public function withAllowCustomerEditingName(
        bool $allowCustomerEditingName
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingName'] = $allowCustomerEditingName;

        return $obj;
    }

    public function withAllowCustomerEditingState(
        bool $allowCustomerEditingState
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingState'] = $allowCustomerEditingState;

        return $obj;
    }

    public function withAllowCustomerEditingStreet(
        bool $allowCustomerEditingStreet
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingStreet'] = $allowCustomerEditingStreet;

        return $obj;
    }

    public function withAllowCustomerEditingZipcode(
        bool $allowCustomerEditingZipcode
    ): self {
        $obj = clone $this;
        $obj['allowCustomerEditingZipcode'] = $allowCustomerEditingZipcode;

        return $obj;
    }

    /**
     * If the customer is allowed to apply discount code, set it to true.
     *
     * Default is true
     */
    public function withAllowDiscountCode(bool $allowDiscountCode): self
    {
        $obj = clone $this;
        $obj['allowDiscountCode'] = $allowDiscountCode;

        return $obj;
    }

    /**
     * If phone number is collected from customer, set it to rue.
     *
     * Default is true
     */
    public function withAllowPhoneNumberCollection(
        bool $allowPhoneNumberCollection
    ): self {
        $obj = clone $this;
        $obj['allowPhoneNumberCollection'] = $allowPhoneNumberCollection;

        return $obj;
    }

    /**
     * If the customer is allowed to add tax id, set it to true.
     *
     * Default is true
     */
    public function withAllowTaxID(bool $allowTaxID): self
    {
        $obj = clone $this;
        $obj['allowTaxID'] = $allowTaxID;

        return $obj;
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
        $obj = clone $this;
        $obj['alwaysCreateNewCustomer'] = $alwaysCreateNewCustomer;

        return $obj;
    }
}
