<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Products\ImagesService::update()
 *
 * @phpstan-type ImageUpdateParamsShape = array{forceUpdate?: bool|null}
 */
final class ImageUpdateParams implements BaseModel
{
    /** @use SdkModel<ImageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?bool $forceUpdate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $forceUpdate = null): self
    {
        $self = new self;

        null !== $forceUpdate && $self['forceUpdate'] = $forceUpdate;

        return $self;
    }

    public function withForceUpdate(bool $forceUpdate): self
    {
        $self = clone $this;
        $self['forceUpdate'] = $forceUpdate;

        return $self;
    }
}
