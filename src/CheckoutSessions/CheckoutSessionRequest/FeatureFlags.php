<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FeatureFlagsShape = array{
 *   allow_currency_selection?: bool|null,
 *   allow_customer_editing_city?: bool|null,
 *   allow_customer_editing_country?: bool|null,
 *   allow_customer_editing_email?: bool|null,
 *   allow_customer_editing_name?: bool|null,
 *   allow_customer_editing_state?: bool|null,
 *   allow_customer_editing_street?: bool|null,
 *   allow_customer_editing_zipcode?: bool|null,
 *   allow_discount_code?: bool|null,
 *   allow_phone_number_collection?: bool|null,
 *   allow_tax_id?: bool|null,
 *   always_create_new_customer?: bool|null,
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
    #[Api(optional: true)]
    public ?bool $allow_currency_selection;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_city;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_country;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_email;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_name;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_state;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_street;

    #[Api(optional: true)]
    public ?bool $allow_customer_editing_zipcode;

    /**
     * If the customer is allowed to apply discount code, set it to true.
     *
     * Default is true
     */
    #[Api(optional: true)]
    public ?bool $allow_discount_code;

    /**
     * If phone number is collected from customer, set it to rue.
     *
     * Default is true
     */
    #[Api(optional: true)]
    public ?bool $allow_phone_number_collection;

    /**
     * If the customer is allowed to add tax id, set it to true.
     *
     * Default is true
     */
    #[Api(optional: true)]
    public ?bool $allow_tax_id;

    /**
     * Set to true if a new customer object should be created.
     * By default email is used to find an existing customer to attach the session to.
     *
     * Default is false
     */
    #[Api(optional: true)]
    public ?bool $always_create_new_customer;

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
        ?bool $allow_currency_selection = null,
        ?bool $allow_customer_editing_city = null,
        ?bool $allow_customer_editing_country = null,
        ?bool $allow_customer_editing_email = null,
        ?bool $allow_customer_editing_name = null,
        ?bool $allow_customer_editing_state = null,
        ?bool $allow_customer_editing_street = null,
        ?bool $allow_customer_editing_zipcode = null,
        ?bool $allow_discount_code = null,
        ?bool $allow_phone_number_collection = null,
        ?bool $allow_tax_id = null,
        ?bool $always_create_new_customer = null,
    ): self {
        $obj = new self;

        null !== $allow_currency_selection && $obj->allow_currency_selection = $allow_currency_selection;
        null !== $allow_customer_editing_city && $obj->allow_customer_editing_city = $allow_customer_editing_city;
        null !== $allow_customer_editing_country && $obj->allow_customer_editing_country = $allow_customer_editing_country;
        null !== $allow_customer_editing_email && $obj->allow_customer_editing_email = $allow_customer_editing_email;
        null !== $allow_customer_editing_name && $obj->allow_customer_editing_name = $allow_customer_editing_name;
        null !== $allow_customer_editing_state && $obj->allow_customer_editing_state = $allow_customer_editing_state;
        null !== $allow_customer_editing_street && $obj->allow_customer_editing_street = $allow_customer_editing_street;
        null !== $allow_customer_editing_zipcode && $obj->allow_customer_editing_zipcode = $allow_customer_editing_zipcode;
        null !== $allow_discount_code && $obj->allow_discount_code = $allow_discount_code;
        null !== $allow_phone_number_collection && $obj->allow_phone_number_collection = $allow_phone_number_collection;
        null !== $allow_tax_id && $obj->allow_tax_id = $allow_tax_id;
        null !== $always_create_new_customer && $obj->always_create_new_customer = $always_create_new_customer;

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
        $obj->allow_currency_selection = $allowCurrencySelection;

        return $obj;
    }

    public function withAllowCustomerEditingCity(
        bool $allowCustomerEditingCity
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_city = $allowCustomerEditingCity;

        return $obj;
    }

    public function withAllowCustomerEditingCountry(
        bool $allowCustomerEditingCountry
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_country = $allowCustomerEditingCountry;

        return $obj;
    }

    public function withAllowCustomerEditingEmail(
        bool $allowCustomerEditingEmail
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_email = $allowCustomerEditingEmail;

        return $obj;
    }

    public function withAllowCustomerEditingName(
        bool $allowCustomerEditingName
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_name = $allowCustomerEditingName;

        return $obj;
    }

    public function withAllowCustomerEditingState(
        bool $allowCustomerEditingState
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_state = $allowCustomerEditingState;

        return $obj;
    }

    public function withAllowCustomerEditingStreet(
        bool $allowCustomerEditingStreet
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_street = $allowCustomerEditingStreet;

        return $obj;
    }

    public function withAllowCustomerEditingZipcode(
        bool $allowCustomerEditingZipcode
    ): self {
        $obj = clone $this;
        $obj->allow_customer_editing_zipcode = $allowCustomerEditingZipcode;

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
        $obj->allow_discount_code = $allowDiscountCode;

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
        $obj->allow_phone_number_collection = $allowPhoneNumberCollection;

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
        $obj->allow_tax_id = $allowTaxID;

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
        $obj->always_create_new_customer = $alwaysCreateNewCustomer;

        return $obj;
    }
}
