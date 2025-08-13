<?php

declare(strict_types=1);

namespace DodoPayments\Addons;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Misc\Currency;
use DodoPayments\Misc\TaxCategory;

/**
 * @phpstan-type create_params = array{
 *   currency: Currency::*,
 *   name: string,
 *   price: int,
 *   taxCategory: TaxCategory::*,
 *   description?: string|null,
 * }
 */
final class AddonCreateParams implements BaseModel
{
    use Model;
    use Params;

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
    #[Api(optional: true)]
    public ?string $description;

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
    public static function from(
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
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Name of the Addon.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Amount of the addon.
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Tax category applied to this Addon.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }

    /**
     * Optional description of the Addon.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
