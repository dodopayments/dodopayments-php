<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\MetersService::update()
 *
 * @phpstan-type MeterUpdateParamsShape = array{
 *   description?: string|null, measurementUnit?: string|null, name?: string|null
 * }
 */
final class MeterUpdateParams implements BaseModel
{
    /** @use SdkModel<MeterUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Description of the meter. Send `null` to remove the description. Omit it to keep it.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Measurement unit.
     */
    #[Optional('measurement_unit', nullable: true)]
    public ?string $measurementUnit;

    /**
     * Name of the meter.
     */
    #[Optional(nullable: true)]
    public ?string $name;

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
        ?string $description = null,
        ?string $measurementUnit = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $measurementUnit && $self['measurementUnit'] = $measurementUnit;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Description of the meter. Send `null` to remove the description. Omit it to keep it.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Measurement unit.
     */
    public function withMeasurementUnit(?string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    /**
     * Name of the meter.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
