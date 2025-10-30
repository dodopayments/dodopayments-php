<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BrandUpdateImagesResponseShape = array{
 *   imageID: string, url: string
 * }
 */
final class BrandUpdateImagesResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BrandUpdateImagesResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * UUID that will be used as the image identifier/key suffix.
     */
    #[Api('image_id')]
    public string $imageID;

    /**
     * Presigned URL to upload the image.
     */
    #[Api]
    public string $url;

    /**
     * `new BrandUpdateImagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandUpdateImagesResponse::with(imageID: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandUpdateImagesResponse)->withImageID(...)->withURL(...)
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
    public static function with(string $imageID, string $url): self
    {
        $obj = new self;

        $obj->imageID = $imageID;
        $obj->url = $url;

        return $obj;
    }

    /**
     * UUID that will be used as the image identifier/key suffix.
     */
    public function withImageID(string $imageID): self
    {
        $obj = clone $this;
        $obj->imageID = $imageID;

        return $obj;
    }

    /**
     * Presigned URL to upload the image.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
