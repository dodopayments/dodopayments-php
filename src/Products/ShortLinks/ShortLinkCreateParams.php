<?php

declare(strict_types=1);

namespace Dodopayments\Products\ShortLinks;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Gives a Short Checkout URL with custom slug for a product.
 * Uses a Static Checkout URL under the hood.
 *
 * @see Dodopayments\Services\Products\ShortLinksService::create()
 *
 * @phpstan-type ShortLinkCreateParamsShape = array{
 *   slug: string, staticCheckoutParams?: array<string,string>|null
 * }
 */
final class ShortLinkCreateParams implements BaseModel
{
    /** @use SdkModel<ShortLinkCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Slug for the short link.
     */
    #[Required]
    public string $slug;

    /**
     * Static Checkout URL parameters to apply to the resulting
     * short URL.
     *
     * @var array<string,string>|null $staticCheckoutParams
     */
    #[Optional('static_checkout_params', map: 'string', nullable: true)]
    public ?array $staticCheckoutParams;

    /**
     * `new ShortLinkCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ShortLinkCreateParams::with(slug: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ShortLinkCreateParams)->withSlug(...)
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
     *
     * @param array<string,string>|null $staticCheckoutParams
     */
    public static function with(
        string $slug,
        ?array $staticCheckoutParams = null
    ): self {
        $self = new self;

        $self['slug'] = $slug;

        null !== $staticCheckoutParams && $self['staticCheckoutParams'] = $staticCheckoutParams;

        return $self;
    }

    /**
     * Slug for the short link.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Static Checkout URL parameters to apply to the resulting
     * short URL.
     *
     * @param array<string,string>|null $staticCheckoutParams
     */
    public function withStaticCheckoutParams(?array $staticCheckoutParams): self
    {
        $self = clone $this;
        $self['staticCheckoutParams'] = $staticCheckoutParams;

        return $self;
    }
}
