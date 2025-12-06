<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicensesService::activate()
 *
 * @phpstan-type LicenseActivateParamsShape = array{
 *   license_key: string, name: string
 * }
 */
final class LicenseActivateParams implements BaseModel
{
    /** @use SdkModel<LicenseActivateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $license_key;

    #[Api]
    public string $name;

    /**
     * `new LicenseActivateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseActivateParams::with(license_key: ..., name: ...)
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
    public static function with(string $license_key, string $name): self
    {
        $obj = new self;

        $obj['license_key'] = $license_key;
        $obj['name'] = $name;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj['license_key'] = $licenseKey;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
