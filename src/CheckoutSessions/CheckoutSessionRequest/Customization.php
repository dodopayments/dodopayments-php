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
 * @phpstan-type customization_alias = array{
 *   forceLanguage?: string|null,
 *   showOnDemandTag?: bool,
 *   showOrderDetails?: bool,
 *   theme?: value-of<Theme>,
 * }
 */
final class Customization implements BaseModel
{
    /** @use SdkModel<customization_alias> */
    use SdkModel;

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    #[Api('force_language', nullable: true, optional: true)]
    public ?string $forceLanguage;

    /**
     * Show on demand tag.
     *
     * Default is true
     */
    #[Api('show_on_demand_tag', optional: true)]
    public ?bool $showOnDemandTag;

    /**
     * Show order details by default.
     *
     * Default is true
     */
    #[Api('show_order_details', optional: true)]
    public ?bool $showOrderDetails;

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
        ?string $forceLanguage = null,
        ?bool $showOnDemandTag = null,
        ?bool $showOrderDetails = null,
        Theme|string|null $theme = null,
    ): self {
        $obj = new self;

        null !== $forceLanguage && $obj->forceLanguage = $forceLanguage;
        null !== $showOnDemandTag && $obj->showOnDemandTag = $showOnDemandTag;
        null !== $showOrderDetails && $obj->showOrderDetails = $showOrderDetails;
        null !== $theme && $obj['theme'] = $theme;

        return $obj;
    }

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    public function withForceLanguage(?string $forceLanguage): self
    {
        $obj = clone $this;
        $obj->forceLanguage = $forceLanguage;

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
        $obj->showOnDemandTag = $showOnDemandTag;

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
        $obj->showOrderDetails = $showOrderDetails;

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
