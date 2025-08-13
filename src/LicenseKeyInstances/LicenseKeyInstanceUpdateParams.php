<?php

declare(strict_types=1);

namespace DodoPayments\LicenseKeyInstances;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

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
