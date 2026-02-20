<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response struct representing meter-credit entitlement mapping cart details for a subscription.
 *
 * @phpstan-type MeterCreditEntitlementCartShape = array{
 *   creditEntitlementID: string,
 *   meterID: string,
 *   meterName: string,
 *   meterUnitsPerCredit: string,
 *   productID: string,
 * }
 */
final class MeterCreditEntitlementCart implements BaseModel
{
    /** @use SdkModel<MeterCreditEntitlementCartShape> */
    use SdkModel;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('meter_id')]
    public string $meterID;

    #[Required('meter_name')]
    public string $meterName;

    #[Required('meter_units_per_credit')]
    public string $meterUnitsPerCredit;

    #[Required('product_id')]
    public string $productID;

    /**
     * `new MeterCreditEntitlementCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeterCreditEntitlementCart::with(
     *   creditEntitlementID: ...,
     *   meterID: ...,
     *   meterName: ...,
     *   meterUnitsPerCredit: ...,
     *   productID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeterCreditEntitlementCart)
     *   ->withCreditEntitlementID(...)
     *   ->withMeterID(...)
     *   ->withMeterName(...)
     *   ->withMeterUnitsPerCredit(...)
     *   ->withProductID(...)
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
        string $creditEntitlementID,
        string $meterID,
        string $meterName,
        string $meterUnitsPerCredit,
        string $productID,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['meterID'] = $meterID;
        $self['meterName'] = $meterName;
        $self['meterUnitsPerCredit'] = $meterUnitsPerCredit;
        $self['productID'] = $productID;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withMeterID(string $meterID): self
    {
        $self = clone $this;
        $self['meterID'] = $meterID;

        return $self;
    }

    public function withMeterName(string $meterName): self
    {
        $self = clone $this;
        $self['meterName'] = $meterName;

        return $self;
    }

    public function withMeterUnitsPerCredit(string $meterUnitsPerCredit): self
    {
        $self = clone $this;
        $self['meterUnitsPerCredit'] = $meterUnitsPerCredit;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }
}
