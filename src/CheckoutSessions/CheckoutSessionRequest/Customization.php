<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization\Theme;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Customization for the checkout session page.
 *
 * @phpstan-type CustomizationShape = array{
 *   force_language?: string|null,
 *   show_on_demand_tag?: bool|null,
 *   show_order_details?: bool|null,
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
    #[Api(nullable: true, optional: true)]
    public ?string $force_language;

    /**
     * Show on demand tag.
     *
     * Default is true
     */
    #[Api(optional: true)]
    public ?bool $show_on_demand_tag;

    /**
     * Show order details by default.
     *
     * Default is true
     */
    #[Api(optional: true)]
    public ?bool $show_order_details;

    /**
     * Theme of the page.
     *
     * Default is `System`.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Api(enum: Theme::class, optional: true)]
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
        ?string $force_language = null,
        ?bool $show_on_demand_tag = null,
        ?bool $show_order_details = null,
        Theme|string|null $theme = null,
    ): self {
        $obj = new self;

        null !== $force_language && $obj['force_language'] = $force_language;
        null !== $show_on_demand_tag && $obj['show_on_demand_tag'] = $show_on_demand_tag;
        null !== $show_order_details && $obj['show_order_details'] = $show_order_details;
        null !== $theme && $obj['theme'] = $theme;

        return $obj;
    }

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    public function withForceLanguage(?string $forceLanguage): self
    {
        $obj = clone $this;
        $obj['force_language'] = $forceLanguage;

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
        $obj['show_on_demand_tag'] = $showOnDemandTag;

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
        $obj['show_order_details'] = $showOrderDetails;

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
