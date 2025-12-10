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
 *   freeThreshold: int,
 *   measurementUnit: string,
 *   meterID: string,
 *   name: string,
 *   pricePerUnit: string,
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

    #[Required('free_threshold')]
    public int $freeThreshold;

    #[Required('measurement_unit')]
    public string $measurementUnit;

    #[Required('meter_id')]
    public string $meterID;

    #[Required]
    public string $name;

    #[Required('price_per_unit')]
    public string $pricePerUnit;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   currency: ...,
     *   freeThreshold: ...,
     *   measurementUnit: ...,
     *   meterID: ...,
     *   name: ...,
     *   pricePerUnit: ...,
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
        int $freeThreshold,
        string $measurementUnit,
        string $meterID,
        string $name,
        string $pricePerUnit,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['freeThreshold'] = $freeThreshold;
        $self['measurementUnit'] = $measurementUnit;
        $self['meterID'] = $meterID;
        $self['name'] = $name;
        $self['pricePerUnit'] = $pricePerUnit;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withFreeThreshold(int $freeThreshold): self
    {
        $self = clone $this;
        $self['freeThreshold'] = $freeThreshold;

        return $self;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    public function withMeterID(string $meterID): self
    {
        $self = clone $this;
        $self['meterID'] = $meterID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPricePerUnit(string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
