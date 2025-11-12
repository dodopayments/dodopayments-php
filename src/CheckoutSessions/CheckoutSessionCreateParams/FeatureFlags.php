<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FeatureFlagsShape = array{
 *   allow_currency_selection?: bool|null,
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
        ?bool $allow_discount_code = null,
        ?bool $allow_phone_number_collection = null,
        ?bool $allow_tax_id = null,
        ?bool $always_create_new_customer = null,
    ): self {
        $obj = new self;

        null !== $allow_currency_selection && $obj->allow_currency_selection = $allow_currency_selection;
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
