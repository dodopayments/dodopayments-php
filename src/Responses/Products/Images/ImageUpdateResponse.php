<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Products\Images;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $url, ?string $imageID = null): self
    {
        $obj = new self;

        $obj->url = $url;

        null !== $imageID && $obj->imageID = $imageID;

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
        $obj->imageID = $imageID;

        return $obj;
    }
}
