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
 * @see Dodopayments\Addons->create
 *
 * @phpstan-type addon_create_params = array{
 *   currency: Currency::*,
 *   name: string,
 *   price: int,
 *   taxCategory: TaxCategory::*,
 *   description?: string|null,
 * }
 */
final class AddonCreateParams implements BaseModel
{
    /** @use SdkModel<addon_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The currency of the Addon.
     *
     * @var Currency::* $currency
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
     * @var TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency::* $currency
     * @param TaxCategory::* $taxCategory
     */
    public static function with(
        string $currency,
        string $name,
        int $price,
        string $taxCategory,
        ?string $description = null,
    ): self {
        $obj = new self;

        $obj->currency = $currency;
        $obj->name = $name;
        $obj->price = $price;
        $obj->taxCategory = $taxCategory;

        null !== $description && $obj->description = $description;

        return $obj;
    }

    /**
     * The currency of the Addon.
     *
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

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
     * @param TaxCategory::* $taxCategory
     */
    public function withTaxCategory(string $taxCategory): self
    {
        $obj = clone $this;
        $obj->taxCategory = $taxCategory;

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
