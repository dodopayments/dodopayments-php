<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type feature_flags = array{
 *   allowCurrencySelection?: bool|null,
 *   allowDiscountCode?: bool|null,
 *   allowPhoneNumberCollection?: bool|null,
 *   allowTaxID?: bool|null,
 *   alwaysCreateNewCustomer?: bool|null,
 * }
 */
final class FeatureFlags implements BaseModel
{
    /** @use SdkModel<feature_flags> */
    use SdkModel;

    /**
     * if customer is allowed to change currency, set it to true.
     *
     * Default is true
     */
    #[Api('allow_currency_selection', optional: true)]
    public ?bool $allowCurrencySelection;

    /**
     * If the customer is allowed to apply discount code, set it to true.
     *
     * Default is true
     */
    #[Api('allow_discount_code', optional: true)]
    public ?bool $allowDiscountCode;

    /**
     * If phone number is collected from customer, set it to rue.
     *
     * Default is true
     */
    #[Api('allow_phone_number_collection', optional: true)]
    public ?bool $allowPhoneNumberCollection;

    /**
     * If the customer is allowed to add tax id, set it to true.
     *
     * Default is true
     */
    #[Api('allow_tax_id', optional: true)]
    public ?bool $allowTaxID;

    /**
     * Set to true if a new customer object should be created.
     * By default email is used to find an existing customer to attach the session to.
     *
     * Default is false
     */
    #[Api('always_create_new_customer', optional: true)]
    public ?bool $alwaysCreateNewCustomer;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $allowCurrencySelection = null,
        ?bool $allowDiscountCode = null,
        ?bool $allowPhoneNumberCollection = null,
        ?bool $allowTaxID = null,
        ?bool $alwaysCreateNewCustomer = null,
    ): self {
        $obj = new self;

        null !== $allowCurrencySelection && $obj->allowCurrencySelection = $allowCurrencySelection;
        null !== $allowDiscountCode && $obj->allowDiscountCode = $allowDiscountCode;
        null !== $allowPhoneNumberCollection && $obj->allowPhoneNumberCollection = $allowPhoneNumberCollection;
        null !== $allowTaxID && $obj->allowTaxID = $allowTaxID;
        null !== $alwaysCreateNewCustomer && $obj->alwaysCreateNewCustomer = $alwaysCreateNewCustomer;

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
        $obj->allowCurrencySelection = $allowCurrencySelection;

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
        $obj->allowDiscountCode = $allowDiscountCode;

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
        $obj->allowPhoneNumberCollection = $allowPhoneNumberCollection;

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
        $obj->allowTaxID = $allowTaxID;

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
        $obj->alwaysCreateNewCustomer = $alwaysCreateNewCustomer;

        return $obj;
    }
}
