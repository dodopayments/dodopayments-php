<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicensesService::deactivate()
 *
 * @phpstan-type LicenseDeactivateParamsShape = array{
 *   license_key: string, license_key_instance_id: string
 * }
 */
final class LicenseDeactivateParams implements BaseModel
{
    /** @use SdkModel<LicenseDeactivateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $license_key;

    #[Api]
    public string $license_key_instance_id;

    /**
     * `new LicenseDeactivateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseDeactivateParams::with(license_key: ..., license_key_instance_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseDeactivateParams)
     *   ->withLicenseKey(...)
     *   ->withLicenseKeyInstanceID(...)
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
        string $license_key,
        string $license_key_instance_id
    ): self {
        $obj = new self;

        $obj->license_key = $license_key;
        $obj->license_key_instance_id = $license_key_instance_id;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj->license_key = $licenseKey;

        return $obj;
    }

    public function withLicenseKeyInstanceID(string $licenseKeyInstanceID): self
    {
        $obj = clone $this;
        $obj->license_key_instance_id = $licenseKeyInstanceID;

        return $obj;
    }
}
