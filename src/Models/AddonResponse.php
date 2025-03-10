<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class AddonResponse
{
    /**
     * Unique identifier for the business to which the addon belongs.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * Created time
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    #[SerializedName('currency')]
    public Currency $currency;

    /**
     * Optional description of the Addon
     */
    #[SerializedName('description')]
    public ?string $description;

    /**
     * id of the Addon
     */
    #[SerializedName('id')]
    public string $id;

    /**
     * Image of the Addon
     */
    #[SerializedName('image')]
    public ?string $image;

    /**
     * Name of the Addon
     */
    #[SerializedName('name')]
    public string $name;

    /**
     * Amount of the addon
     */
    #[SerializedName('price')]
    public int $price;

    /**
     * Represents the different categories of taxation applicable to various products and services.
     */
    #[SerializedName('tax_category')]
    public TaxCategory $taxCategory;

    /**
     * Updated time
     */
    #[SerializedName('updated_at')]
    public string $updatedAt;

    public function __construct(
        string $businessId,
        string $createdAt,
        Currency $currency,
        ?string $description = null,
        string $id,
        ?string $image = null,
        string $name,
        int $price,
        TaxCategory $taxCategory,
        string $updatedAt
    ) {
        $this->businessId = $businessId;
        $this->createdAt = $createdAt;
        $this->currency = $currency;
        $this->description = $description;
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->price = $price;
        $this->taxCategory = $taxCategory;
        $this->updatedAt = $updatedAt;
    }
}
