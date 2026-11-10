<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * The billing address of an invoice request.
 *
 * @phpstan-type BillingAddressShape = array{
 *   country: CountryCode|value-of<CountryCode>,
 *   city?: string|null,
 *   state?: string|null,
 *   street?: string|null,
 *   zipcode?: string|null,
 * }
 */
final class BillingAddress implements BaseModel
{
    /** @use SdkModel<BillingAddressShape> */
    use SdkModel;

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @var value-of<CountryCode> $country
     */
    #[Required(enum: CountryCode::class)]
    public string $country;

    #[Optional(nullable: true)]
    public ?string $city;

    #[Optional(nullable: true)]
    public ?string $state;

    #[Optional(nullable: true)]
    public ?string $street;

    #[Optional(nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CountryCode|value-of<CountryCode> $country
     */
    public static function with(
        CountryCode|string $country,
        ?string $city = null,
        ?string $state = null,
        ?string $street = null,
        ?string $zipcode = null,
    ): self {
        $self = new self;

        $self['country'] = $country;

        null !== $city && $self['city'] = $city;
        null !== $state && $self['state'] = $state;
        null !== $street && $self['street'] = $street;
        null !== $zipcode && $self['zipcode'] = $zipcode;

        return $self;
    }

    /**
     * Two-letter ISO country code (ISO 3166-1 alpha-2).
     *
     * @param CountryCode|value-of<CountryCode> $country
     */
    public function withCountry(CountryCode|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    public function withStreet(?string $street): self
    {
        $self = clone $this;
        $self['street'] = $street;

        return $self;
    }

    public function withZipcode(?string $zipcode): self
    {
        $self = clone $this;
        $self['zipcode'] = $zipcode;

        return $self;
    }
}
