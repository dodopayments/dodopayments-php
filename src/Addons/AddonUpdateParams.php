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
 * @see Dodopayments\Services\AddonsService::update()
 *
 * @phpstan-type AddonUpdateParamsShape = array{
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   image_id?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   tax_category?: null|TaxCategory|value-of<TaxCategory>,
 * }
 */
final class AddonUpdateParams implements BaseModel
{
    /** @use SdkModel<AddonUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The currency of the Addon.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Api(enum: Currency::class, nullable: true, optional: true)]
    public ?string $currency;

    /**
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Addon image id after its uploaded to S3.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image_id;

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * Amount of the addon.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $price;

    /**
     * Tax category of the Addon.
     *
     * @var value-of<TaxCategory>|null $tax_category
     */
    #[Api(enum: TaxCategory::class, nullable: true, optional: true)]
    public ?string $tax_category;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency|value-of<Currency>|null $currency
     * @param TaxCategory|value-of<TaxCategory>|null $tax_category
     */
    public static function with(
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $image_id = null,
        ?string $name = null,
        ?int $price = null,
        TaxCategory|string|null $tax_category = null,
    ): self {
        $obj = new self;

        null !== $currency && $obj['currency'] = $currency;
        null !== $description && $obj->description = $description;
        null !== $image_id && $obj->image_id = $image_id;
        null !== $name && $obj->name = $name;
        null !== $price && $obj->price = $price;
        null !== $tax_category && $obj['tax_category'] = $tax_category;

        return $obj;
    }

    /**
     * The currency of the Addon.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Addon image id after its uploaded to S3.
     */
    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj->image_id = $imageID;

        return $obj;
    }

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(?int $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Tax category of the Addon.
     *
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public function withTaxCategory(TaxCategory|string|null $taxCategory): self
    {
        $obj = clone $this;
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }
}
