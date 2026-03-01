<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * Response struct representing usage-based meter cart details for a subscription.
 *
 * @phpstan-type MeterCartResponseItemShape = array{
 *   currency: Currency|value-of<Currency>,
 *   freeThreshold: int,
 *   measurementUnit: string,
 *   meterID: string,
 *   name: string,
 *   description?: string|null,
 *   pricePerUnit?: string|null,
 * }
 */
final class MeterCartResponseItem implements BaseModel
{
    /** @use SdkModel<MeterCartResponseItemShape> */
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

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

    /**
     * `new MeterCartResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeterCartResponseItem::with(
     *   currency: ...,
     *   freeThreshold: ...,
     *   measurementUnit: ...,
     *   meterID: ...,
     *   name: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeterCartResponseItem)
     *   ->withCurrency(...)
     *   ->withFreeThreshold(...)
     *   ->withMeasurementUnit(...)
     *   ->withMeterID(...)
     *   ->withName(...)
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
        ?string $description = null,
        ?string $pricePerUnit = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['freeThreshold'] = $freeThreshold;
        $self['measurementUnit'] = $measurementUnit;
        $self['meterID'] = $meterID;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;

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

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withPricePerUnit(?string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }
}
