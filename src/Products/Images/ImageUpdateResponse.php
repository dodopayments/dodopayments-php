<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type ImageUpdateResponseShape = array{
 *   url: string, image_id?: string|null
 * }
 */
final class ImageUpdateResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ImageUpdateResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $url;

    #[Api(nullable: true, optional: true)]
    public ?string $image_id;

    /**
     * `new ImageUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ImageUpdateResponse::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ImageUpdateResponse)->withURL(...)
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
    public static function with(string $url, ?string $image_id = null): self
    {
        $obj = new self;

        $obj->url = $url;

        null !== $image_id && $obj->image_id = $image_id;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj->image_id = $imageID;

        return $obj;
    }
}
