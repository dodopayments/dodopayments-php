<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Api;
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
 *   tax_category: TaxCategory|value-of<TaxCategory>,
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
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Name of the Addon.
     */
    #[Api]
    public string $name;

    /**
     * Amount of the addon.
     */
    #[Api]
    public int $price;

    /**
     * Tax category applied to this Addon.
     *
     * @var value-of<TaxCategory> $tax_category
     */
    #[Api(enum: TaxCategory::class)]
    public string $tax_category;

    /**
     * Optional description of the Addon.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * `new AddonCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonCreateParams::with(currency: ..., name: ..., price: ..., tax_category: ...)
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
     * @param TaxCategory|value-of<TaxCategory> $tax_category
     */
    public static function with(
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $tax_category,
        ?string $description = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj->name = $name;
        $obj->price = $price;
        $obj['tax_category'] = $tax_category;

        null !== $description && $obj->description = $description;

        return $obj;
    }

    /**
     * The currency of the Addon.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * Name of the Addon.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(int $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Tax category applied to this Addon.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $obj = clone $this;
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }

    /**
     * Optional description of the Addon.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }
}
