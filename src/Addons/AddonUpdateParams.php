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
 * @phpstan-type update_params = array{
 *   currency?: Currency::*,
 *   description?: string|null,
 *   imageID?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   taxCategory?: TaxCategory::*,
 * }
 */
final class AddonUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The currency of the Addon.
     *
     * @var null|Currency::* $currency
     */
    #[Api(enum: Currency::class, optional: true)]
    public ?string $currency;

    /**
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Addon image id after its uploaded to S3.
     */
    #[Api('image_id', optional: true)]
    public ?string $imageID;

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Amount of the addon.
     */
    #[Api(optional: true)]
    public ?int $price;

    /**
     * Tax category of the Addon.
     *
     * @var null|TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class, optional: true)]
    public ?string $taxCategory;

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
        ?string $currency = null,
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?int $price = null,
        ?string $taxCategory = null,
    ): self {
        $obj = new self;

        null !== $currency && $obj->currency = $currency;
        null !== $description && $obj->description = $description;
        null !== $imageID && $obj->imageID = $imageID;
        null !== $name && $obj->name = $name;
        null !== $price && $obj->price = $price;
        null !== $taxCategory && $obj->taxCategory = $taxCategory;

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
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Addon image id after its uploaded to S3.
     */
    public function setImageID(?string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Amount of the addon.
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Tax category of the Addon.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }
}
