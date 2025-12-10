<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type LicenseValidateResponseShape = array{valid: bool}
 */
final class LicenseValidateResponse implements BaseModel
{
    /** @use SdkModel<LicenseValidateResponseShape> */
    use SdkModel;

    #[Required]
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
        $self = new self;

        $self['valid'] = $valid;

        return $self;
    }

    public function withValid(bool $valid): self
    {
        $self = clone $this;
        $self['valid'] = $valid;

        return $self;
    }
}
