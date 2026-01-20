<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type MeterShape = array{
 *   measurementUnit: string,
 *   name: string,
 *   pricePerUnit: string,
 *   description?: string|null,
 *   freeThreshold?: int|null,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    #[Required('measurement_unit')]
    public string $measurementUnit;

    #[Required]
    public string $name;

    #[Required('price_per_unit')]
    public string $pricePerUnit;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('free_threshold', nullable: true)]
    public ?int $freeThreshold;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(measurementUnit: ..., name: ..., pricePerUnit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meter)->withMeasurementUnit(...)->withName(...)->withPricePerUnit(...)
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
     */
    public static function with(
        string $measurementUnit,
        string $name,
        string $pricePerUnit,
        ?string $description = null,
        ?int $freeThreshold = null,
    ): self {
        $self = new self;

        $self['measurementUnit'] = $measurementUnit;
        $self['name'] = $name;
        $self['pricePerUnit'] = $pricePerUnit;

        null !== $description && $self['description'] = $description;
        null !== $freeThreshold && $self['freeThreshold'] = $freeThreshold;

        return $self;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

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

    public function withFreeThreshold(?int $freeThreshold): self
    {
        $self = clone $this;
        $self['freeThreshold'] = $freeThreshold;

        return $self;
    }
}
