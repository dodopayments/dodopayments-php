<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Products;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Misc\Currency;
use DodoPayments\Misc\TaxCategory;
use DodoPayments\Products\Price\OneTimePrice;
use DodoPayments\Products\Price\RecurringPrice;

/**
 * @phpstan-type product_list_response_alias = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   metadata: array<string, string>,
 *   productID: string,
 *   taxCategory: TaxCategory::*,
 *   updatedAt: \DateTimeInterface,
 *   currency?: Currency::*,
 *   description?: string|null,
 *   image?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   priceDetail?: OneTimePrice|RecurringPrice,
 *   taxInclusive?: bool|null,
 * }
 */
final class ProductListResponse implements BaseModel
{
    use Model;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Timestamp when the product was created.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Api('is_recurring')]
    public bool $isRecurring;

    /**
     * Additional custom data associated with the product.
     *
     * @var array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'))]
    public array $metadata;

    /**
     * Unique identifier for the product.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Tax category associated with the product.
     *
     * @var TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Timestamp when the product was last updated.
     */
    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Currency of the price.
     *
     * @var null|Currency::* $currency
     */
    #[Api(enum: Currency::class, optional: true)]
    public ?string $currency;

    /**
     * Description of the product, optional.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * URL of the product image, optional.
     */
    #[Api(optional: true)]
    public ?string $image;

    /**
     * Name of the product, optional.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Price of the product, optional.
     *
     * The price is represented in the lowest denomination of the currency.
     * For example:
     * - In USD, a price of `$12.34` would be represented as `1234` (cents).
     * - In JPY, a price of `¥1500` would be represented as `1500` (yen).
     * - In INR, a price of `₹1234.56` would be represented as `123456` (paise).
     *
     * This ensures precision and avoids floating-point rounding errors.
     */
    #[Api(optional: true)]
    public ?int $price;

    /**
     * Details of the price.
     */
    #[Api('price_detail', optional: true)]
    public null|OneTimePrice|RecurringPrice $priceDetail;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

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
     * @param array<string, string> $metadata
     * @param TaxCategory::* $taxCategory
     * @param Currency::* $currency
     */
    public static function from(
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isRecurring,
        array $metadata,
        string $productID,
        string $taxCategory,
        \DateTimeInterface $updatedAt,
        ?string $currency = null,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?int $price = null,
        null|OneTimePrice|RecurringPrice $priceDetail = null,
        ?bool $taxInclusive = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->isRecurring = $isRecurring;
        $obj->metadata = $metadata;
        $obj->productID = $productID;
        $obj->taxCategory = $taxCategory;
        $obj->updatedAt = $updatedAt;

        null !== $currency && $obj->currency = $currency;
        null !== $description && $obj->description = $description;
        null !== $image && $obj->image = $image;
        null !== $name && $obj->name = $name;
        null !== $price && $obj->price = $price;
        null !== $priceDetail && $obj->priceDetail = $priceDetail;
        null !== $taxInclusive && $obj->taxInclusive = $taxInclusive;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * Timestamp when the product was created.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function setIsRecurring(bool $isRecurring): self
    {
        $this->isRecurring = $isRecurring;

        return $this;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Unique identifier for the product.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Tax category associated with the product.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Currency of the price.
     *
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Description of the product, optional.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * URL of the product image, optional.
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Name of the product, optional.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Price of the product, optional.
     *
     * The price is represented in the lowest denomination of the currency.
     * For example:
     * - In USD, a price of `$12.34` would be represented as `1234` (cents).
     * - In JPY, a price of `¥1500` would be represented as `1500` (yen).
     * - In INR, a price of `₹1234.56` would be represented as `123456` (paise).
     *
     * This ensures precision and avoids floating-point rounding errors.
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Details of the price.
     */
    public function setPriceDetail(
        OneTimePrice|RecurringPrice $priceDetail
    ): self {
        $this->priceDetail = $priceDetail;

        return $this;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function setTaxInclusive(?bool $taxInclusive): self
    {
        $this->taxInclusive = $taxInclusive;

        return $this;
    }
}
