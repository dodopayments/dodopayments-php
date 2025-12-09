<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ImageUpdateResponseShape = array{
 *   url: string, imageID?: string|null
 * }
 */
final class ImageUpdateResponse implements BaseModel
{
    /** @use SdkModel<ImageUpdateResponseShape> */
    use SdkModel;

    #[Required]
    public string $url;

    #[Optional('image_id', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $url, ?string $imageID = null): self
    {
        $obj = new self;

        $obj['url'] = $url;

        null !== $imageID && $obj['imageID'] = $imageID;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj['imageID'] = $imageID;

        return $obj;
    }
}
