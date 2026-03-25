<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductCollectionUpdateImagesResponseShape = array{
 *   url: string, imageID?: string|null
 * }
 */
final class ProductCollectionUpdateImagesResponse implements BaseModel
{
    /** @use SdkModel<ProductCollectionUpdateImagesResponseShape> */
    use SdkModel;

    /**
     * Presigned S3 URL for uploading the image.
     */
    #[Required]
    public string $url;

    /**
     * Optional image ID (present when force_update is true).
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

    /**
     * `new ProductCollectionUpdateImagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionUpdateImagesResponse::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionUpdateImagesResponse)->withURL(...)
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
    public static function with(string $url, ?string $imageID = null): self
    {
        $self = new self;

        $self['url'] = $url;

        null !== $imageID && $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * Presigned S3 URL for uploading the image.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional image ID (present when force_update is true).
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }
}
