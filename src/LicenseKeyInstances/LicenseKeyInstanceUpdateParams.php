<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_params = array{name: string}
 */
final class LicenseKeyInstanceUpdateParams implements BaseModel
{
    use Model;
    use Params;

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
        self::introspect();
        $this->unsetOptionalProperties();
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
