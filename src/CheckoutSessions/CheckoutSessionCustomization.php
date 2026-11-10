<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CheckoutSessionCustomization\PaymentMethodLayout;
use Dodopayments\CheckoutSessions\CheckoutSessionCustomization\Theme;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ThemeConfigShape from \Dodopayments\CheckoutSessions\ThemeConfig
 *
 * @phpstan-type CheckoutSessionCustomizationShape = array{
 *   forceLanguage?: string|null,
 *   paymentMethodLayout?: null|PaymentMethodLayout|value-of<PaymentMethodLayout>,
 *   showOnDemandTag?: bool|null,
 *   showOrderDetails?: bool|null,
 *   theme?: null|Theme|value-of<Theme>,
 *   themeConfig?: null|ThemeConfig|ThemeConfigShape,
 * }
 */
final class CheckoutSessionCustomization implements BaseModel
{
    /** @use SdkModel<CheckoutSessionCustomizationShape> */
    use SdkModel;

    /**
     * Force the checkout interface to render in a specific language (e.g. `en`, `es`).
     */
    #[Optional('force_language', nullable: true)]
    public ?string $forceLanguage;

    /**
     * How a single-page checkout shows the payment methods. You can set it only
     * when `feature_flags.single_page` is true.
     *
     * Default is `accordion`.
     *
     * @var value-of<PaymentMethodLayout>|null $paymentMethodLayout
     */
    #[Optional(
        'payment_method_layout',
        enum: PaymentMethodLayout::class,
        nullable: true
    )]
    public ?string $paymentMethodLayout;

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
     * If not provided, uses the business-configured theme from business_themes table.
     *
     * @var value-of<Theme>|null $theme
     */
    #[Optional(enum: Theme::class, nullable: true)]
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
     * @param PaymentMethodLayout|value-of<PaymentMethodLayout>|null $paymentMethodLayout
     * @param Theme|value-of<Theme>|null $theme
     * @param ThemeConfig|ThemeConfigShape|null $themeConfig
     */
    public static function with(
        ?string $forceLanguage = null,
        PaymentMethodLayout|string|null $paymentMethodLayout = null,
        ?bool $showOnDemandTag = null,
        ?bool $showOrderDetails = null,
        Theme|string|null $theme = null,
        ThemeConfig|array|null $themeConfig = null,
    ): self {
        $self = new self;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $paymentMethodLayout && $self['paymentMethodLayout'] = $paymentMethodLayout;
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
     * How a single-page checkout shows the payment methods. You can set it only
     * when `feature_flags.single_page` is true.
     *
     * Default is `accordion`.
     *
     * @param PaymentMethodLayout|value-of<PaymentMethodLayout>|null $paymentMethodLayout
     */
    public function withPaymentMethodLayout(
        PaymentMethodLayout|string|null $paymentMethodLayout
    ): self {
        $self = clone $this;
        $self['paymentMethodLayout'] = $paymentMethodLayout;

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
     * If not provided, uses the business-configured theme from business_themes table.
     *
     * @param Theme|value-of<Theme>|null $theme
     */
    public function withTheme(Theme|string|null $theme): self
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
