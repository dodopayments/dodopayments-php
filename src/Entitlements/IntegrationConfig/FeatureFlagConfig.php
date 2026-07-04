<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FeatureFlagConfigShape = array{
 *   featureID: string, featureType: 'boolean'
 * }
 */
final class FeatureFlagConfig implements BaseModel
{
    /** @use SdkModel<FeatureFlagConfigShape> */
    use SdkModel;

    /**
     * Type of capability conferred.
     *
     * @var 'boolean' $featureType
     */
    #[Required('feature_type')]
    public string $featureType = 'boolean';

    /**
     * Merchant-chosen identifier for the capability this entitlement
     * unlocks. Not unique across entitlements.
     */
    #[Required('feature_id')]
    public string $featureID;

    /**
     * `new FeatureFlagConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeatureFlagConfig::with(featureID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeatureFlagConfig)->withFeatureID(...)
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
     * Merchant-chosen identifier for the capability this entitlement
     * unlocks. Not unique across entitlements.
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
