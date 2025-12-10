<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicensesService::validate()
 *
 * @phpstan-type LicenseValidateParamsShape = array{
 *   licenseKey: string, licenseKeyInstanceID?: string|null
 * }
 */
final class LicenseValidateParams implements BaseModel
{
    /** @use SdkModel<LicenseValidateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('license_key')]
    public string $licenseKey;

    #[Optional('license_key_instance_id', nullable: true)]
    public ?string $licenseKeyInstanceID;

    /**
     * `new LicenseValidateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseValidateParams::with(licenseKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseValidateParams)->withLicenseKey(...)
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
        string $licenseKey,
        ?string $licenseKeyInstanceID = null
    ): self {
        $self = new self;

        $self['licenseKey'] = $licenseKey;

        null !== $licenseKeyInstanceID && $self['licenseKeyInstanceID'] = $licenseKeyInstanceID;

        return $self;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $self = clone $this;
        $self['licenseKey'] = $licenseKey;

        return $self;
    }

    public function withLicenseKeyInstanceID(
        ?string $licenseKeyInstanceID
    ): self {
        $self = clone $this;
        $self['licenseKeyInstanceID'] = $licenseKeyInstanceID;

        return $self;
    }
}
