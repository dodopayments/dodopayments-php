<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type license_activate_params = array{licenseKey: string, name: string}
 */
final class LicenseActivateParams implements BaseModel
{
    /** @use SdkModel<license_activate_params> */
    use SdkModel;
    use SdkParams;

    #[Api('license_key')]
    public string $licenseKey;

    #[Api]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $licenseKey, string $name): self
    {
        $obj = new self;

        $obj->licenseKey = $licenseKey;
        $obj->name = $name;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj->licenseKey = $licenseKey;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
