<?php

declare(strict_types=1);

namespace Dodopayments\Discounts\Discount;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * A per-currency discount option (response shape). `max_amount_possible`
 * mirrors the DB column of the same name.
 *
 * @phpstan-type CurrencyOptionShape = array{
 *   currency: Currency|value-of<Currency>,
 *   isDefault: bool,
 *   minimumSubtotal: int,
 *   maxAmountPossible?: int|null,
 * }
 */
final class CurrencyOption implements BaseModel
{
    /** @use SdkModel<CurrencyOptionShape> */
    use SdkModel;

    /**
     * The currency this option applies to.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Whether this is the default row FX conversions pivot from.
     */
    #[Required('is_default')]
    public bool $isDefault;

    /**
     * Eligible-cart threshold in this currency's subunits (0 = no minimum).
     */
    #[Required('minimum_subtotal')]
    public int $minimumSubtotal;

    /**
     * The most this code discounts in this currency's subunits (flat deduction
     * or percentage cap).
     */
    #[Optional('max_amount_possible', nullable: true)]
    public ?int $maxAmountPossible;

    /**
     * `new CurrencyOption()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrencyOption::with(currency: ..., isDefault: ..., minimumSubtotal: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrencyOption)
     *   ->withCurrency(...)
     *   ->withIsDefault(...)
     *   ->withMinimumSubtotal(...)
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
     */
    public static function with(
        Currency|string $currency,
        bool $isDefault,
        int $minimumSubtotal,
        ?int $maxAmountPossible = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['isDefault'] = $isDefault;
        $self['minimumSubtotal'] = $minimumSubtotal;

        null !== $maxAmountPossible && $self['maxAmountPossible'] = $maxAmountPossible;

        return $self;
    }

    /**
     * The currency this option applies to.
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
     * Whether this is the default row FX conversions pivot from.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * Eligible-cart threshold in this currency's subunits (0 = no minimum).
     */
    public function withMinimumSubtotal(int $minimumSubtotal): self
    {
        $self = clone $this;
        $self['minimumSubtotal'] = $minimumSubtotal;

        return $self;
    }

    /**
     * The most this code discounts in this currency's subunits (flat deduction
     * or percentage cap).
     */
    public function withMaxAmountPossible(?int $maxAmountPossible): self
    {
        $self = clone $this;
        $self['maxAmountPossible'] = $maxAmountPossible;

        return $self;
    }
}
