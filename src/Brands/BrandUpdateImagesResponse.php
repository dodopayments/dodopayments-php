<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandUpdateImagesResponseShape = array{
 *   imageID: string, url: string
 * }
 */
final class BrandUpdateImagesResponse implements BaseModel
{
    /** @use SdkModel<BrandUpdateImagesResponseShape> */
    use SdkModel;

    /**
     * UUID that will be used as the image identifier/key suffix.
     */
    #[Required('image_id')]
    public string $imageID;

    /**
     * Presigned URL to upload the image.
     */
    #[Required]
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
        $self = new self;

        $self['imageID'] = $imageID;
        $self['url'] = $url;

        return $self;
    }

    /**
     * UUID that will be used as the image identifier/key suffix.
     */
    public function withImageID(string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * Presigned URL to upload the image.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
