<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddMeterToPriceShape = array{
 *   meterID: string,
 *   pricePerUnit: string,
 *   creditEntitlementID?: string|null,
 *   description?: string|null,
 *   freeThreshold?: int|null,
 *   measurementUnit?: string|null,
 *   meterUnitsPerCredit?: string|null,
 *   name?: string|null,
 * }
 */
final class AddMeterToPrice implements BaseModel
{
    /** @use SdkModel<AddMeterToPriceShape> */
    use SdkModel;

    #[Required('meter_id')]
    public string $meterID;

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    #[Required('price_per_unit')]
    public string $pricePerUnit;

    /**
     * Optional credit entitlement ID to link this meter to for credit-based billing.
     */
    #[Optional('credit_entitlement_id', nullable: true)]
    public ?string $creditEntitlementID;

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('free_threshold', nullable: true)]
    public ?int $freeThreshold;

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    #[Optional('measurement_unit', nullable: true)]
    public ?string $measurementUnit;

    /**
     * Number of meter units that equal one credit. Required when credit_entitlement_id is set.
     */
    #[Optional('meter_units_per_credit', nullable: true)]
    public ?string $meterUnitsPerCredit;

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new AddMeterToPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddMeterToPrice::with(meterID: ..., pricePerUnit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddMeterToPrice)->withMeterID(...)->withPricePerUnit(...)
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
        string $meterID,
        string $pricePerUnit,
        ?string $creditEntitlementID = null,
        ?string $description = null,
        ?int $freeThreshold = null,
        ?string $measurementUnit = null,
        ?string $meterUnitsPerCredit = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['meterID'] = $meterID;
        $self['pricePerUnit'] = $pricePerUnit;

        null !== $creditEntitlementID && $self['creditEntitlementID'] = $creditEntitlementID;
        null !== $description && $self['description'] = $description;
        null !== $freeThreshold && $self['freeThreshold'] = $freeThreshold;
        null !== $measurementUnit && $self['measurementUnit'] = $measurementUnit;
        null !== $meterUnitsPerCredit && $self['meterUnitsPerCredit'] = $meterUnitsPerCredit;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withMeterID(string $meterID): self
    {
        $self = clone $this;
        $self['meterID'] = $meterID;

        return $self;
    }

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Optional credit entitlement ID to link this meter to for credit-based billing.
     */
    public function withCreditEntitlementID(?string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
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

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    public function withMeasurementUnit(?string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    /**
     * Number of meter units that equal one credit. Required when credit_entitlement_id is set.
     */
    public function withMeterUnitsPerCredit(?string $meterUnitsPerCredit): self
    {
        $self = clone $this;
        $self['meterUnitsPerCredit'] = $meterUnitsPerCredit;

        return $self;
    }

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
