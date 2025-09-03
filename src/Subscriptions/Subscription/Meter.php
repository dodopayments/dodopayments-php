<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * Response struct representing usage-based meter cart details for a subscription.
 *
 * @phpstan-type meter_alias = array{
 *   currency: Currency::*,
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
    /** @use SdkModel<meter_alias> */
    use SdkModel;

    /** @var Currency::* $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api('free_threshold')]
    public int $freeThreshold;

    #[Api('measurement_unit')]
    public string $measurementUnit;

    #[Api('meter_id')]
    public string $meterID;

    #[Api]
    public string $name;

    #[Api('price_per_unit')]
    public string $pricePerUnit;

    #[Api(nullable: true, optional: true)]
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
     * @param Currency::* $currency
     */
    public static function with(
        string $currency,
        int $freeThreshold,
        string $measurementUnit,
        string $meterID,
        string $name,
        string $pricePerUnit,
        ?string $description = null,
    ): self {
        $obj = new self;

        $obj->currency = $currency;
        $obj->freeThreshold = $freeThreshold;
        $obj->measurementUnit = $measurementUnit;
        $obj->meterID = $meterID;
        $obj->name = $name;
        $obj->pricePerUnit = $pricePerUnit;

        null !== $description && $obj->description = $description;

        return $obj;
    }

    /**
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    public function withFreeThreshold(int $freeThreshold): self
    {
        $obj = clone $this;
        $obj->freeThreshold = $freeThreshold;

        return $obj;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurementUnit = $measurementUnit;

        return $obj;
    }

    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj->meterID = $meterID;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj->pricePerUnit = $pricePerUnit;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }
}
