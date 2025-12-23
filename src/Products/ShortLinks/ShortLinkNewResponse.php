<?php

declare(strict_types=1);

namespace Dodopayments\Products\ShortLinks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ShortLinkNewResponseShape = array{
 *   fullURL: string, shortURL: string
 * }
 */
final class ShortLinkNewResponse implements BaseModel
{
    /** @use SdkModel<ShortLinkNewResponseShape> */
    use SdkModel;

    /**
     * Full URL.
     */
    #[Required('full_url')]
    public string $fullURL;

    /**
     * Short URL.
     */
    #[Required('short_url')]
    public string $shortURL;

    /**
     * `new ShortLinkNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ShortLinkNewResponse::with(fullURL: ..., shortURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ShortLinkNewResponse)->withFullURL(...)->withShortURL(...)
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
    public static function with(string $fullURL, string $shortURL): self
    {
        $self = new self;

        $self['fullURL'] = $fullURL;
        $self['shortURL'] = $shortURL;

        return $self;
    }

    /**
     * Full URL.
     */
    public function withFullURL(string $fullURL): self
    {
        $self = clone $this;
        $self['fullURL'] = $fullURL;

        return $self;
    }

    /**
     * Short URL.
     */
    public function withShortURL(string $shortURL): self
    {
        $self = clone $this;
        $self['shortURL'] = $shortURL;

        return $self;
    }
}
