<?php

declare(strict_types=1);

namespace DodoPayments\Addons;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Misc\Currency;
use DodoPayments\Misc\TaxCategory;

/**
 * @phpstan-type addon_response_alias = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency::*,
 *   name: string,
 *   price: int,
 *   taxCategory: TaxCategory::*,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   image?: string|null,
 * }
 */
final class AddonResponse implements BaseModel
{
    use Model;

    /**
     * id of the Addon.
     */
    #[Api]
    public string $id;

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Created time.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Currency of the Addon.
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
     * Updated time.
     */
    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Optional description of the Addon.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Image of the Addon.
     */
    #[Api(optional: true)]
    public ?string $image;

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
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $currency,
        string $name,
        int $price,
        string $taxCategory,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?string $image = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->name = $name;
        $obj->price = $price;
        $obj->taxCategory = $taxCategory;
        $obj->updatedAt = $updatedAt;

        null !== $description && $obj->description = $description;
        null !== $image && $obj->image = $image;

        return $obj;
    }

    /**
     * id of the Addon.
     */
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * Created time.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Currency of the Addon.
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
     * Updated time.
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * Image of the Addon.
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
