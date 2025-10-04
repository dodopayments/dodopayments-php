<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type license_validate_response = array{valid: bool}
 */
final class LicenseValidateResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<license_validate_response> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public bool $valid;

    /**
     * `new LicenseValidateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseValidateResponse::with(valid: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseValidateResponse)->withValid(...)
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
    public static function with(bool $valid): self
    {
        $obj = new self;

        $obj->valid = $valid;

        return $obj;
    }

    public function withValid(bool $valid): self
    {
        $obj = clone $this;
        $obj->valid = $valid;

        return $obj;
    }
}
