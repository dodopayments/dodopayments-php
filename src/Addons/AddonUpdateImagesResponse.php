<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddonUpdateImagesResponseShape = array{
 *   imageID: string, url: string
 * }
 */
final class AddonUpdateImagesResponse implements BaseModel
{
    /** @use SdkModel<AddonUpdateImagesResponseShape> */
    use SdkModel;

    #[Required('image_id')]
    public string $imageID;

    #[Required]
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
        $self = new self;

        $self['imageID'] = $imageID;
        $self['url'] = $url;

        return $self;
    }

    public function withImageID(string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
