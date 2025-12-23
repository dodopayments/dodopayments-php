<?php

declare(strict_types=1);

namespace Dodopayments\Products\ShortLinks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ShortLinkListResponseShape = array{
 *   createdAt: \DateTimeInterface,
 *   fullURL: string,
 *   productID: string,
 *   shortURL: string,
 * }
 */
final class ShortLinkListResponse implements BaseModel
{
    /** @use SdkModel<ShortLinkListResponseShape> */
    use SdkModel;

    /**
     * When the short url was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Full URL the short url redirects to.
     */
    #[Required('full_url')]
    public string $fullURL;

    /**
     * Product ID associated with the short link.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Short URL.
     */
    #[Required('short_url')]
    public string $shortURL;

    /**
     * `new ShortLinkListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ShortLinkListResponse::with(
     *   createdAt: ..., fullURL: ..., productID: ..., shortURL: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ShortLinkListResponse)
     *   ->withCreatedAt(...)
     *   ->withFullURL(...)
     *   ->withProductID(...)
     *   ->withShortURL(...)
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
    public static function with(
        \DateTimeInterface $createdAt,
        string $fullURL,
        string $productID,
        string $shortURL,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['fullURL'] = $fullURL;
        $self['productID'] = $productID;
        $self['shortURL'] = $shortURL;

        return $self;
    }

    /**
     * When the short url was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Full URL the short url redirects to.
     */
    public function withFullURL(string $fullURL): self
    {
        $self = clone $this;
        $self['fullURL'] = $fullURL;

        return $self;
    }

    /**
     * Product ID associated with the short link.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

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
