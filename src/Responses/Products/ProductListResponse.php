<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\MapOf;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;

final class ProductListResponse implements BaseModel
{
    use SdkModel;

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
     * @var Currency::*|null $currency
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
    public OneTimePrice|RecurringPrice|null $priceDetail;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

    /**
     * `new ProductListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductListResponse::with(
     *   businessID: ...,
     *   createdAt: ...,
     *   isRecurring: ...,
     *   metadata: ...,
     *   productID: ...,
     *   taxCategory: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductListResponse)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withIsRecurring(...)
     *   ->withMetadata(...)
     *   ->withProductID(...)
     *   ->withTaxCategory(...)
     *   ->withUpdatedAt(...)
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
     * @param array<string, string> $metadata
     * @param TaxCategory::* $taxCategory
     * @param Currency::* $currency
     */
    public static function with(
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
        OneTimePrice|RecurringPrice|null $priceDetail = null,
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
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $obj = clone $this;
        $obj->isRecurring = $isRecurring;

        return $obj;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    /**
     * Tax category associated with the product.
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
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * Currency of the price.
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
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
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
    public function withPrice(?int $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Details of the price.
     */
    public function withPriceDetail(
        OneTimePrice|RecurringPrice $priceDetail
    ): self {
        $obj = clone $this;
        $obj->priceDetail = $priceDetail;

        return $obj;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj->taxInclusive = $taxInclusive;

        return $obj;
    }
}
