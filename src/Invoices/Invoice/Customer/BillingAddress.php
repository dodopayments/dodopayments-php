<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\Customer;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * A draft can have no country yet. Finalise needs it.
 *
 * @phpstan-type BillingAddressShape = array{
 *   city?: string|null,
 *   country?: null|CountryCode|value-of<CountryCode>,
 *   state?: string|null,
 *   street?: string|null,
 *   zipcode?: string|null,
 * }
 */
final class BillingAddress implements BaseModel
{
    /** @use SdkModel<BillingAddressShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $city;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $country
     */
    #[Optional(enum: CountryCode::class, nullable: true)]
    public ?string $country;

    #[Optional(nullable: true)]
    public ?string $state;

    #[Optional(nullable: true)]
    public ?string $street;

    #[Optional(nullable: true)]
    public ?string $zipcode;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CountryCode|value-of<CountryCode>|null $country
     */
    public static function with(
        ?string $city = null,
        CountryCode|string|null $country = null,
        ?string $state = null,
        ?string $street = null,
        ?string $zipcode = null,
    ): self {
        $self = new self;

        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $state && $self['state'] = $state;
        null !== $street && $self['street'] = $street;
        null !== $zipcode && $self['zipcode'] = $zipcode;

        return $self;
    }

    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode>|null $country
     */
    public function withCountry(CountryCode|string|null $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

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
