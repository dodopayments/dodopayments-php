<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Customization for the checkout session page.
 */
final class Customization implements BaseModel
{
    use SdkModel;

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
     * @var Theme::*|null $theme
     */
    #[Api(enum: Theme::class, optional: true)]
    public ?string $theme;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Theme::*|null $theme
     */
    public static function with(
        ?bool $showOnDemandTag = null,
        ?bool $showOrderDetails = null,
        ?string $theme = null,
    ): self {
        $obj = new self;

        null !== $showOnDemandTag && $obj->showOnDemandTag = $showOnDemandTag;
        null !== $showOrderDetails && $obj->showOrderDetails = $showOrderDetails;
        null !== $theme && $obj->theme = $theme;

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
     * @param Theme::* $theme
     */
    public function withTheme(string $theme): self
    {
        $obj = clone $this;
        $obj->theme = $theme;

        return $obj;
    }
}
