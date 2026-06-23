<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\Products\LocalizedPricesService::create()
 *
 * @phpstan-type LocalizedPriceCreateParamsShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   countryCode?: null|CountryCode|value-of<CountryCode>,
 * }
 */
final class LocalizedPriceCreateParams implements BaseModel
{
    /** @use SdkModel<LocalizedPriceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount in the smallest currency unit (e.g., cents). Must be greater than zero.
     */
    #[Required]
    public int $amount;

    /**
     * Currency to charge in. Must be a supported currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Required when the product's pricing_mode is by_country; forbidden when by_currency.
     *
     * @var value-of<CountryCode>|null $countryCode
     */
    #[Optional('country_code', enum: CountryCode::class, nullable: true)]
    public ?string $countryCode;

    /**
     * `new LocalizedPriceCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocalizedPriceCreateParams::with(amount: ..., currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocalizedPriceCreateParams)->withAmount(...)->withCurrency(...)
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
     * @param CountryCode|value-of<CountryCode>|null $countryCode
     */
    public static function with(
        int $amount,
        Currency|string $currency,
        CountryCode|string|null $countryCode = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;

        null !== $countryCode && $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Amount in the smallest currency unit (e.g., cents). Must be greater than zero.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Currency to charge in. Must be a supported currency.
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
     * Required when the product's pricing_mode is by_country; forbidden when by_currency.
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
