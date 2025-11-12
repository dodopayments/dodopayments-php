<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Licenses->validate
 *
 * @phpstan-type LicenseValidateParamsShape = array{
 *   license_key: string, license_key_instance_id?: string|null
 * }
 */
final class LicenseValidateParams implements BaseModel
{
    /** @use SdkModel<LicenseValidateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $license_key;

    #[Api(nullable: true, optional: true)]
    public ?string $license_key_instance_id;

    /**
     * `new LicenseValidateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseValidateParams::with(license_key: ...)
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
        string $license_key,
        ?string $license_key_instance_id = null
    ): self {
        $obj = new self;

        $obj->license_key = $license_key;

        null !== $license_key_instance_id && $obj->license_key_instance_id = $license_key_instance_id;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj->license_key = $licenseKey;

        return $obj;
    }

    public function withLicenseKeyInstanceID(
        ?string $licenseKeyInstanceID
    ): self {
        $obj = clone $this;
        $obj->license_key_instance_id = $licenseKeyInstanceID;

        return $obj;
    }
}
