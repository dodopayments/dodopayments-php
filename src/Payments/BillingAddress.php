<?php

declare(strict_types=1);

namespace DodoPayments\Payments;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Misc\CountryCode;

/**
 * @phpstan-type billing_address_alias = array{
 *   city: string,
 *   country: CountryCode::*,
 *   state: string,
 *   street: string,
 *   zipcode: string,
 * }
 */
final class BillingAddress implements BaseModel
{
    use Model;

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
    public static function from(
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
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @param CountryCode::* $country
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * State or province name.
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Street address including house number and unit/apartment if applicable.
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Postal code or ZIP code.
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
