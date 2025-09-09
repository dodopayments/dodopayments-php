<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;

/**
 * @phpstan-type product_list_response = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   metadata: array<string, string>,
 *   productID: string,
 *   taxCategory: value-of<TaxCategory>,
 *   updatedAt: \DateTimeInterface,
 *   currency?: value-of<Currency>|null,
 *   description?: string|null,
 *   image?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   priceDetail?: null|OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   taxInclusive?: bool|null,
 * }
 */
final class ProductListResponse implements BaseModel
{
    /** @use SdkModel<product_list_response> */
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
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the product.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Tax category associated with the product.
     *
     * @var value-of<TaxCategory> $taxCategory
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
     * @var value-of<Currency>|null $currency
     */
    #[Api(enum: Currency::class, nullable: true, optional: true)]
    public ?string $currency;

    /**
     * Description of the product, optional.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * URL of the product image, optional.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image;

    /**
     * Name of the product, optional.
     */
    #[Api(nullable: true, optional: true)]
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
    #[Api(nullable: true, optional: true)]
    public ?int $price;

    /**
     * Details of the price.
     */
    #[Api('price_detail', nullable: true, optional: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $priceDetail;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', nullable: true, optional: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string> $metadata
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param Currency|value-of<Currency>|null $currency
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isRecurring,
        array $metadata,
        string $productID,
        TaxCategory|string $taxCategory,
        \DateTimeInterface $updatedAt,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?int $price = null,
        OneTimePrice|RecurringPrice|UsageBasedPrice|null $priceDetail = null,
        ?bool $taxInclusive = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->isRecurring = $isRecurring;
        $obj->metadata = $metadata;
        $obj->productID = $productID;
        $obj->taxCategory = $taxCategory instanceof TaxCategory ? $taxCategory->value : $taxCategory;
        $obj->updatedAt = $updatedAt;

        null !== $currency && $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
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
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $obj = clone $this;
        $obj->taxCategory = $taxCategory instanceof TaxCategory ? $taxCategory->value : $taxCategory;

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
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

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
        OneTimePrice|RecurringPrice|UsageBasedPrice|null $priceDetail
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
