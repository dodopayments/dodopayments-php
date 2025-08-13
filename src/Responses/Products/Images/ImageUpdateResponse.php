<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Products\Images;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type image_update_response_alias = array{
 *   url: string, imageID?: string|null
 * }
 */
final class ImageUpdateResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $url;

    #[Api('image_id', optional: true)]
    public ?string $imageID;

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
    public static function from(string $url, ?string $imageID = null): self
    {
        $obj = new self;

        $obj->url = $url;

        null !== $imageID && $obj->imageID = $imageID;

        return $obj;
    }

    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setImageID(?string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }
}
