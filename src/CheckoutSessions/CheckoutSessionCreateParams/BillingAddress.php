<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * Billing address information for the session.
 *
 * @phpstan-type billing_address = array{
 *   country: CountryCode::*,
 *   city?: string|null,
 *   state?: string|null,
 *   street?: string|null,
 *   zipcode?: string|null,
 * }
 */
final class BillingAddress implements BaseModel
{
    /** @use SdkModel<billing_address> */
    use SdkModel;

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @var CountryCode::* $country
     */
    #[Api(enum: CountryCode::class)]
    public string $country;

    /**
     * City name.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $city;

    /**
     * State or province name.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $state;

    /**
     * Street address including house number and unit/apartment if applicable.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $street;

    /**
     * Postal code or ZIP code.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $zipcode;

    /**
     * `new BillingAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BillingAddress::with(country: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BillingAddress)->withCountry(...)
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
        string $country,
        ?string $city = null,
        ?string $state = null,
        ?string $street = null,
        ?string $zipcode = null,
    ): self {
        $obj = new self;

        $obj->country = $country;

        null !== $city && $obj->city = $city;
        null !== $state && $obj->state = $state;
        null !== $street && $obj->street = $street;
        null !== $zipcode && $obj->zipcode = $zipcode;

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
     * City name.
     */
    public function withCity(?string $city): self
    {
        $obj = clone $this;
        $obj->city = $city;

        return $obj;
    }

    /**
     * State or province name.
     */
    public function withState(?string $state): self
    {
        $obj = clone $this;
        $obj->state = $state;

        return $obj;
    }

    /**
     * Street address including house number and unit/apartment if applicable.
     */
    public function withStreet(?string $street): self
    {
        $obj = clone $this;
        $obj->street = $street;

        return $obj;
    }

    /**
     * Postal code or ZIP code.
     */
    public function withZipcode(?string $zipcode): self
    {
        $obj = clone $this;
        $obj->zipcode = $zipcode;

        return $obj;
    }
}
