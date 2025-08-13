<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type license_validate_response_alias = array{valid: bool}
 */
final class LicenseValidateResponse implements BaseModel
{
    use Model;

    #[Api]
    public bool $valid;

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
    public static function from(bool $valid): self
    {
        $obj = new self;

        $obj->valid = $valid;

        return $obj;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }
}
