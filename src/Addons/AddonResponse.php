<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @phpstan-type AddonResponseShape = array{
 *   id: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   name: string,
 *   price: int,
 *   tax_category: value-of<TaxCategory>,
 *   updated_at: \DateTimeInterface,
 *   description?: string|null,
 *   image?: string|null,
 * }
 */
final class AddonResponse implements BaseModel
{
    /** @use SdkModel<AddonResponseShape> */
    use SdkModel;

    /**
     * id of the Addon.
     */
    #[Api]
    public string $id;

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    #[Api]
    public string $business_id;

    /**
     * Created time.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * Currency of the Addon.
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
     * Updated time.
     */
    #[Api]
    public \DateTimeInterface $updated_at;

    /**
     * Optional description of the Addon.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Image of the Addon.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image;

    /**
     * `new AddonResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonResponse::with(
     *   id: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   currency: ...,
     *   name: ...,
     *   price: ...,
     *   tax_category: ...,
     *   updated_at: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddonResponse)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withName(...)
     *   ->withPrice(...)
     *   ->withTaxCategory(...)
     *   ->withUpdatedAt(...)
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
        string $id,
        string $business_id,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $tax_category,
        \DateTimeInterface $updated_at,
        ?string $description = null,
        ?string $image = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['name'] = $name;
        $obj['price'] = $price;
        $obj['tax_category'] = $tax_category;
        $obj['updated_at'] = $updated_at;

        null !== $description && $obj['description'] = $description;
        null !== $image && $obj['image'] = $image;

        return $obj;
    }

    /**
     * id of the Addon.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Created time.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Currency of the Addon.
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
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(int $price): self
    {
        $obj = clone $this;
        $obj['price'] = $price;

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
     * Updated time.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }

    /**
     * Optional description of the Addon.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Image of the Addon.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }
}
