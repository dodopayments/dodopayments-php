<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfigResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FramerConfigShape = array{framerTemplateID: string}
 */
final class FramerConfig implements BaseModel
{
    /** @use SdkModel<FramerConfigShape> */
    use SdkModel;

    #[Required('framer_template_id')]
    public string $framerTemplateID;

    /**
     * `new FramerConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FramerConfig::with(framerTemplateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FramerConfig)->withFramerTemplateID(...)
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
    public static function with(string $framerTemplateID): self
    {
        $self = new self;

        $self['framerTemplateID'] = $framerTemplateID;

        return $self;
    }

    public function withFramerTemplateID(string $framerTemplateID): self
    {
        $self = clone $this;
        $self['framerTemplateID'] = $framerTemplateID;

        return $self;
    }
}
