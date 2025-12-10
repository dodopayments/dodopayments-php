<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @see Dodopayments\Services\AddonsService::create()
 *
 * @phpstan-type AddonCreateParamsShape = array{
 *   currency: Currency|value-of<Currency>,
 *   name: string,
 *   price: int,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   description?: string|null,
 * }
 */
final class AddonCreateParams implements BaseModel
{
    /** @use SdkModel<AddonCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The currency of the Addon.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Name of the Addon.
     */
    #[Required]
    public string $name;

    /**
     * Amount of the addon.
     */
    #[Required]
    public int $price;

    /**
     * Tax category applied to this Addon.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Optional description of the Addon.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new AddonCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonCreateParams::with(currency: ..., name: ..., price: ..., taxCategory: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddonCreateParams)
     *   ->withCurrency(...)
     *   ->withName(...)
     *   ->withPrice(...)
     *   ->withTaxCategory(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public static function with(
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $taxCategory,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['name'] = $name;
        $self['price'] = $price;
        $self['taxCategory'] = $taxCategory;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * The currency of the Addon.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Name of the Addon.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Tax category applied to this Addon.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * Optional description of the Addon.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
