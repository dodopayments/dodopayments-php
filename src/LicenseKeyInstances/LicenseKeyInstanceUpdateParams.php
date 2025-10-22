<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\LicenseKeyInstances->update
 *
 * @phpstan-type license_key_instance_update_params = array{name: string}
 */
final class LicenseKeyInstanceUpdateParams implements BaseModel
{
    /** @use SdkModel<license_key_instance_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $name;

    /**
     * `new LicenseKeyInstanceUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyInstanceUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyInstanceUpdateParams)->withName(...)
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
    public static function with(string $name): self
    {
        $obj = new self;

        $obj->name = $name;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
