<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type LocalizedPriceShape = array{
 *   id: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   mode: PricingMode|value-of<PricingMode>,
 *   productID: string,
 *   updatedAt: \DateTimeInterface,
 *   countryCode?: null|CountryCode|value-of<CountryCode>,
 * }
 */
final class LocalizedPrice implements BaseModel
{
    /** @use SdkModel<LocalizedPriceShape> */
    use SdkModel;

    /**
     * Unique identifier for the localized price.
     */
    #[Required]
    public string $id;

    /**
     * Amount in the smallest currency unit (e.g., cents).
     */
    #[Required]
    public int $amount;

    /**
     * Timestamp when the localized price was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Currency to charge in.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Pricing mode of the rule: by_currency or by_country.
     *
     * @var value-of<PricingMode> $mode
     */
    #[Required(enum: PricingMode::class)]
    public string $mode;

    /**
     * Product this localized price belongs to.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Timestamp when the localized price was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Country the rule applies to. Only set when mode is by_country.
     *
     * @var value-of<CountryCode>|null $countryCode
     */
    #[Optional('country_code', enum: CountryCode::class, nullable: true)]
    public ?string $countryCode;

    /**
     * `new LocalizedPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocalizedPrice::with(
     *   id: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   mode: ...,
     *   productID: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocalizedPrice)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withMode(...)
     *   ->withProductID(...)
     *   ->withUpdatedAt(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param PricingMode|value-of<PricingMode> $mode
     * @param CountryCode|value-of<CountryCode>|null $countryCode
     */
    public static function with(
        string $id,
        int $amount,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        PricingMode|string $mode,
        string $productID,
        \DateTimeInterface $updatedAt,
        CountryCode|string|null $countryCode = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['mode'] = $mode;
        $self['productID'] = $productID;
        $self['updatedAt'] = $updatedAt;

        null !== $countryCode && $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Unique identifier for the localized price.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Amount in the smallest currency unit (e.g., cents).
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Timestamp when the localized price was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Currency to charge in.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Pricing mode of the rule: by_currency or by_country.
     *
     * @param PricingMode|value-of<PricingMode> $mode
     */
    public function withMode(PricingMode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Product this localized price belongs to.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Timestamp when the localized price was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Country the rule applies to. Only set when mode is by_country.
     *
     * @param CountryCode|value-of<CountryCode>|null $countryCode
     */
    public function withCountryCode(CountryCode|string|null $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }
}
