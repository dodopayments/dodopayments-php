<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Products\Images->update
 *
 * @phpstan-type ImageUpdateParamsShape = array{forceUpdate?: bool}
 */
final class ImageUpdateParams implements BaseModel
{
    /** @use SdkModel<ImageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $forceUpdate && $obj->forceUpdate = $forceUpdate;

        return $obj;
    }

    public function withForceUpdate(bool $forceUpdate): self
    {
        $obj = clone $this;
        $obj->forceUpdate = $forceUpdate;

        return $obj;
    }
}
