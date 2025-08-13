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
    public static function from(string $name): self
    {
        $obj = new self;

        $obj->name = $name;

        return $obj;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
