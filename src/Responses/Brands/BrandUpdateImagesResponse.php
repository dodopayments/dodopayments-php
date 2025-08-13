<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_update_images_response_alias = array{
 *   imageID: string, url: string
 * }
 */
final class BrandUpdateImagesResponse implements BaseModel
{
    use Model;

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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(string $imageID, string $url): self
    {
        $obj = new self;

        $obj->imageID = $imageID;
        $obj->url = $url;

        return $obj;
    }

    /**
     * UUID that will be used as the image identifier/key suffix.
     */
    public function setImageID(string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    /**
     * Presigned URL to upload the image.
     */
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
