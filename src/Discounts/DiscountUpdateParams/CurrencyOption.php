<?php

declare(strict_types=1);

namespace Dodopayments\Discounts\DiscountUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * A per-currency discount option (request shape).
 *
 * `max_amount_possible` is the most this code discounts in this currency — the
 * flat deduction for `flat` codes, or the max-discount cap for `percentage`
 * codes. Maps to the DB column of the same name.
 *
 * @phpstan-type CurrencyOptionShape = array{
 *   currency: Currency|value-of<Currency>,
 *   isDefault?: bool|null,
 *   maxAmountPossible?: int|null,
 *   minimumSubtotal?: int|null,
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
     * Whether this row is the default to convert from for unconfigured
     * currencies. At most one row per discount may be default.
     */
    #[Optional('is_default')]
    public ?bool $isDefault;

    /**
     * The most this code discounts in this currency's subunits. For `flat` codes
     * this is the deduction; for `percentage` codes it is the max-discount cap.
     * Must be > 0 if provided.
     */
    #[Optional('max_amount_possible', nullable: true)]
    public ?int $maxAmountPossible;

    /**
     * Eligible-cart threshold in this currency's subunits (0 = no minimum).
     */
    #[Optional('minimum_subtotal')]
    public ?int $minimumSubtotal;

    /**
     * `new CurrencyOption()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrencyOption::with(currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrencyOption)->withCurrency(...)
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
        ?bool $isDefault = null,
        ?int $maxAmountPossible = null,
        ?int $minimumSubtotal = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;

        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $maxAmountPossible && $self['maxAmountPossible'] = $maxAmountPossible;
        null !== $minimumSubtotal && $self['minimumSubtotal'] = $minimumSubtotal;

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
     * Whether this row is the default to convert from for unconfigured
     * currencies. At most one row per discount may be default.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * The most this code discounts in this currency's subunits. For `flat` codes
     * this is the deduction; for `percentage` codes it is the max-discount cap.
     * Must be > 0 if provided.
     */
    public function withMaxAmountPossible(?int $maxAmountPossible): self
    {
        $self = clone $this;
        $self['maxAmountPossible'] = $maxAmountPossible;

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
}
