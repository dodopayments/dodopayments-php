<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants\EntitlementGrant;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Typed feature payload, present only when the entitlement integration is
 * `feature_flag`; `null` for every other integration type.
 *
 * @phpstan-type FeatureShape = array{featureID: string, featureType: 'boolean'}
 */
final class Feature implements BaseModel
{
    /** @use SdkModel<FeatureShape> */
    use SdkModel;

    /**
     * Type of capability conferred.
     *
     * @var 'boolean' $featureType
     */
    #[Required('feature_type')]
    public string $featureType = 'boolean';

    /**
     * Identifier of the capability this grant confers.
     */
    #[Required('feature_id')]
    public string $featureID;

    /**
     * `new Feature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Feature::with(featureID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Feature)->withFeatureID(...)
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
    public static function with(string $featureID): self
    {
        $self = new self;

        $self['featureID'] = $featureID;

        return $self;
    }

    /**
     * Identifier of the capability this grant confers.
     */
    public function withFeatureID(string $featureID): self
    {
        $self = clone $this;
        $self['featureID'] = $featureID;

        return $self;
    }

    /**
     * Type of capability conferred.
     *
     * @param 'boolean' $featureType
     */
    public function withFeatureType(string $featureType): self
    {
        $self = clone $this;
        $self['featureType'] = $featureType;

        return $self;
    }
}
