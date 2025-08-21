<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type deactivate_params = array{
 *   licenseKey: string, licenseKeyInstanceID: string
 * }
 */
final class LicenseDeactivateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api('license_key')]
    public string $licenseKey;

    #[Api('license_key_instance_id')]
    public string $licenseKeyInstanceID;

    /**
     * `new LicenseDeactivateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseDeactivateParams::with(licenseKey: ..., licenseKeyInstanceID: ...)
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $licenseKey,
        string $licenseKeyInstanceID
    ): self {
        $obj = new self;

        $obj->licenseKey = $licenseKey;
        $obj->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj->licenseKey = $licenseKey;

        return $obj;
    }

    public function withLicenseKeyInstanceID(string $licenseKeyInstanceID): self
    {
        $obj = clone $this;
        $obj->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $obj;
    }
}
