<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\ThemeConfig;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Customization for the checkout session page.
 *
 * @phpstan-import-type ThemeConfigShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\ThemeConfig
 *
 * @phpstan-type CustomizationShape = array{
 *   forceLanguage?: string|null,
 *   showOnDemandTag?: bool|null,
 *   showOrderDetails?: bool|null,
 *   theme?: null|Theme|value-of<Theme>,
 *   themeConfig?: null|ThemeConfig|ThemeConfigShape,
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
     * Theme of the page (determines which mode - light/dark/system - to use).
     *
     * Default is `System`.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Optional(enum: Theme::class)]
    public ?string $theme;

    /**
     * Optional custom theme configuration with colors for light and dark modes.
     */
    #[Optional('theme_config', nullable: true)]
    public ?ThemeConfig $themeConfig;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Theme|value-of<Theme>|null $theme
     * @param ThemeConfig|ThemeConfigShape|null $themeConfig
     */
    public static function with(
        ?string $forceLanguage = null,
        ?bool $showOnDemandTag = null,
        ?bool $showOrderDetails = null,
        Theme|string|null $theme = null,
        ThemeConfig|array|null $themeConfig = null,
    ): self {
        $self = new self;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $showOnDemandTag && $self['showOnDemandTag'] = $showOnDemandTag;
        null !== $showOrderDetails && $self['showOrderDetails'] = $showOrderDetails;
        null !== $theme && $self['theme'] = $theme;
        null !== $themeConfig && $self['themeConfig'] = $themeConfig;

        return $self;
    }

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    public function withForceLanguage(?string $forceLanguage): self
    {
        $self = clone $this;
        $self['forceLanguage'] = $forceLanguage;

        return $self;
    }

    /**
     * Show on demand tag.
     *
     * Default is true
     */
    public function withShowOnDemandTag(bool $showOnDemandTag): self
    {
        $self = clone $this;
        $self['showOnDemandTag'] = $showOnDemandTag;

        return $self;
    }

    /**
     * Show order details by default.
     *
     * Default is true
     */
    public function withShowOrderDetails(bool $showOrderDetails): self
    {
        $self = clone $this;
        $self['showOrderDetails'] = $showOrderDetails;

        return $self;
    }

    /**
     * Theme of the page (determines which mode - light/dark/system - to use).
     *
     * Default is `System`.
     *
     * @param Theme|value-of<Theme> $theme
     */
    public function withTheme(Theme|string $theme): self
    {
        $self = clone $this;
        $self['theme'] = $theme;

        return $self;
    }

    /**
     * Optional custom theme configuration with colors for light and dark modes.
     *
     * @param ThemeConfig|ThemeConfigShape|null $themeConfig
     */
    public function withThemeConfig(ThemeConfig|array|null $themeConfig): self
    {
        $self = clone $this;
        $self['themeConfig'] = $themeConfig;

        return $self;
    }
}
