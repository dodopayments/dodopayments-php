<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Customization for the checkout session page.
 *
 * @phpstan-type CustomizationShape = array{
 *   forceLanguage?: string|null,
 *   showOnDemandTag?: bool|null,
 *   showOrderDetails?: bool|null,
 *   theme?: value-of<Theme>|null,
 * }
 */
final class Customization implements BaseModel
{
    /** @use SdkModel<CustomizationShape> */
    use SdkModel;

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    #[Optional('force_language', nullable: true)]
    public ?string $forceLanguage;

    /**
     * Show on demand tag.
     *
     * Default is true
     */
    #[Optional('show_on_demand_tag')]
    public ?bool $showOnDemandTag;

    /**
     * Show order details by default.
     *
     * Default is true
     */
    #[Optional('show_order_details')]
    public ?bool $showOrderDetails;

    /**
     * Theme of the page.
     *
     * Default is `System`.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Optional(enum: Theme::class)]
    public ?string $theme;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Theme|value-of<Theme> $theme
     */
    public static function with(
        ?string $forceLanguage = null,
        ?bool $showOnDemandTag = null,
        ?bool $showOrderDetails = null,
        Theme|string|null $theme = null,
    ): self {
        $obj = new self;

        null !== $forceLanguage && $obj['forceLanguage'] = $forceLanguage;
        null !== $showOnDemandTag && $obj['showOnDemandTag'] = $showOnDemandTag;
        null !== $showOrderDetails && $obj['showOrderDetails'] = $showOrderDetails;
        null !== $theme && $obj['theme'] = $theme;

        return $obj;
    }

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    public function withForceLanguage(?string $forceLanguage): self
    {
        $obj = clone $this;
        $obj['forceLanguage'] = $forceLanguage;

        return $obj;
    }

    /**
     * Show on demand tag.
     *
     * Default is true
     */
    public function withShowOnDemandTag(bool $showOnDemandTag): self
    {
        $obj = clone $this;
        $obj['showOnDemandTag'] = $showOnDemandTag;

        return $obj;
    }

    /**
     * Show order details by default.
     *
     * Default is true
     */
    public function withShowOrderDetails(bool $showOrderDetails): self
    {
        $obj = clone $this;
        $obj['showOrderDetails'] = $showOrderDetails;

        return $obj;
    }

    /**
     * Theme of the page.
     *
     * Default is `System`.
     *
     * @param Theme|value-of<Theme> $theme
     */
    public function withTheme(Theme|string $theme): self
    {
        $obj = clone $this;
        $obj['theme'] = $theme;

        return $obj;
    }
}
