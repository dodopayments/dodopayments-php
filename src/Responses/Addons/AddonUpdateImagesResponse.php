<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Addons;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type addon_update_images_response_alias = array{
 *   imageID: string, url: string
 * }
 */
final class AddonUpdateImagesResponse implements BaseModel
{
    use Model;

    #[Api('image_id')]
    public string $imageID;

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

    public function setImageID(string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
