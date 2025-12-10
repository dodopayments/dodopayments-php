<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicenseKeyInstancesService::update()
 *
 * @phpstan-type LicenseKeyInstanceUpdateParamsShape = array{name: string}
 */
final class LicenseKeyInstanceUpdateParams implements BaseModel
{
    /** @use SdkModel<LicenseKeyInstanceUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
