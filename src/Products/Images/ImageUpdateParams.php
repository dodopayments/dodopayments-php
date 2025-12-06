<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Products\ImagesService::update()
 *
 * @phpstan-type ImageUpdateParamsShape = array{force_update?: bool}
 */
final class ImageUpdateParams implements BaseModel
{
    /** @use SdkModel<ImageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
    public ?bool $force_update;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $force_update = null): self
    {
        $obj = new self;

        null !== $force_update && $obj['force_update'] = $force_update;

        return $obj;
    }

    public function withForceUpdate(bool $forceUpdate): self
    {
        $obj = clone $this;
        $obj['force_update'] = $forceUpdate;

        return $obj;
    }
}
