<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicensesService::activate()
 *
 * @phpstan-type LicenseActivateParamsShape = array{
 *   licenseKey: string, name: string
 * }
 */
final class LicenseActivateParams implements BaseModel
{
    /** @use SdkModel<LicenseActivateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('license_key')]
    public string $licenseKey;

    #[Required]
    public string $name;

    /**
     * `new LicenseActivateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseActivateParams::with(licenseKey: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseActivateParams)->withLicenseKey(...)->withName(...)
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
    public static function with(string $licenseKey, string $name): self
    {
        $self = new self;

        $self['licenseKey'] = $licenseKey;
        $self['name'] = $name;

        return $self;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $self = clone $this;
        $self['licenseKey'] = $licenseKey;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
