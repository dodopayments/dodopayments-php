<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Capability conferred by a `feature_flag` grant.
 *
 * @phpstan-type FeatureShape = array{
 *   featureID: string, featureType: FeatureType|value-of<FeatureType>
 * }
 */
final class Feature implements BaseModel
{
    /** @use SdkModel<FeatureShape> */
    use SdkModel;

    /**
     * Identifier of the capability this grant confers.
     */
    #[Required('feature_id')]
    public string $featureID;

    /**
     * Type of capability conferred.
     *
     * @var value-of<FeatureType> $featureType
     */
    #[Required('feature_type', enum: FeatureType::class)]
    public string $featureType;

    /**
     * `new Feature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Feature::with(featureID: ..., featureType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Feature)->withFeatureID(...)->withFeatureType(...)
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
     * @param FeatureType|value-of<FeatureType> $featureType
     */
    public static function with(
        string $featureID,
        FeatureType|string $featureType
    ): self {
        $self = new self;

        $self['featureID'] = $featureID;
        $self['featureType'] = $featureType;

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
     * @param FeatureType|value-of<FeatureType> $featureType
     */
    public function withFeatureType(FeatureType|string $featureType): self
    {
        $self = clone $this;
        $self['featureType'] = $featureType;

        return $self;
    }
}
