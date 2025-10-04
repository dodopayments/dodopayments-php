<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type addon_update_images_response = array{imageID: string, url: string}
 */
final class AddonUpdateImagesResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<addon_update_images_response> */
    use SdkModel;

    use SdkResponse;

    #[Api('image_id')]
    public string $imageID;

    #[Api]
    public string $url;

    /**
     * `new AddonUpdateImagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonUpdateImagesResponse::with(imageID: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddonUpdateImagesResponse)->withImageID(...)->withURL(...)
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

    public function withImageID(string $imageID): self
    {
        $obj = clone $this;
        $obj->imageID = $imageID;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
