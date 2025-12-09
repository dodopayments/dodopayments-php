<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * Response struct representing usage-based meter cart details for a subscription.
 *
 * @phpstan-type MeterShape = array{
 *   currency: value-of<Currency>,
 *   free_threshold: int,
 *   measurement_unit: string,
 *   meter_id: string,
 *   name: string,
 *   price_per_unit: string,
 *   description?: string|null,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public int $free_threshold;

    #[Required]
    public string $measurement_unit;

    #[Required]
    public string $meter_id;

    #[Required]
    public string $name;

    #[Required]
    public string $price_per_unit;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   currency: ...,
     *   free_threshold: ...,
     *   measurement_unit: ...,
     *   meter_id: ...,
     *   name: ...,
     *   price_per_unit: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meter)
     *   ->withCurrency(...)
     *   ->withFreeThreshold(...)
     *   ->withMeasurementUnit(...)
     *   ->withMeterID(...)
     *   ->withName(...)
     *   ->withPricePerUnit(...)
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
        int $free_threshold,
        string $measurement_unit,
        string $meter_id,
        string $name,
        string $price_per_unit,
        ?string $description = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['free_threshold'] = $free_threshold;
        $obj['measurement_unit'] = $measurement_unit;
        $obj['meter_id'] = $meter_id;
        $obj['name'] = $name;
        $obj['price_per_unit'] = $price_per_unit;

        null !== $description && $obj['description'] = $description;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withFreeThreshold(int $freeThreshold): self
    {
        $obj = clone $this;
        $obj['free_threshold'] = $freeThreshold;

        return $obj;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj['measurement_unit'] = $measurementUnit;

        return $obj;
    }

    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj['meter_id'] = $meterID;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj['price_per_unit'] = $pricePerUnit;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }
}
