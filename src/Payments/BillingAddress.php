<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

final class BillingAddress implements BaseModel
{
    use SdkModel;

    /**
     * City name.
     */
    #[Api]
    public string $city;

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @var CountryCode::* $country
     */
    #[Api(enum: CountryCode::class)]
    public string $country;

    /**
     * State or province name.
     */
    #[Api]
    public string $state;

    /**
     * Street address including house number and unit/apartment if applicable.
     */
    #[Api]
    public string $street;

    /**
     * Postal code or ZIP code.
     */
    #[Api]
    public string $zipcode;

    /**
     * `new BillingAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BillingAddress::with(
     *   city: ..., country: ..., state: ..., street: ..., zipcode: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BillingAddress)
     *   ->withCity(...)
     *   ->withCountry(...)
     *   ->withState(...)
     *   ->withStreet(...)
     *   ->withZipcode(...)
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
     * @param CountryCode::* $country
     */
    public static function with(
        string $city,
        string $country,
        string $state,
        string $street,
        string $zipcode,
    ): self {
        $obj = new self;

        $obj->city = $city;
        $obj->country = $country;
        $obj->state = $state;
        $obj->street = $street;
        $obj->zipcode = $zipcode;

        return $obj;
    }

    /**
     * City name.
     */
    public function withCity(string $city): self
    {
        $obj = clone $this;
        $obj->city = $city;

        return $obj;
    }

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @param CountryCode::* $country
     */
    public function withCountry(string $country): self
    {
        $obj = clone $this;
        $obj->country = $country;

        return $obj;
    }

    /**
     * State or province name.
     */
    public function withState(string $state): self
    {
        $obj = clone $this;
        $obj->state = $state;

        return $obj;
    }

    /**
     * Street address including house number and unit/apartment if applicable.
     */
    public function withStreet(string $street): self
    {
        $obj = clone $this;
        $obj->street = $street;

        return $obj;
    }

    /**
     * Postal code or ZIP code.
     */
    public function withZipcode(string $zipcode): self
    {
        $obj = clone $this;
        $obj->zipcode = $zipcode;

        return $obj;
    }
}
