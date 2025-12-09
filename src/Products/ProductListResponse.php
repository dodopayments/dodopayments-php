<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\OneTimePrice\Type;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type ProductListResponseShape = array{
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   is_recurring: bool,
 *   metadata: array<string,string>,
 *   product_id: string,
 *   tax_category: value-of<TaxCategory>,
 *   updated_at: \DateTimeInterface,
 *   currency?: value-of<Currency>|null,
 *   description?: string|null,
 *   image?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   price_detail?: null|OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   tax_inclusive?: bool|null,
 * }
 */
final class ProductListResponse implements BaseModel
{
    /** @use SdkModel<ProductListResponseShape> */
    use SdkModel;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Required]
    public string $business_id;

    /**
     * Timestamp when the product was created.
     */
    #[Required]
    public \DateTimeInterface $created_at;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Required]
    public bool $is_recurring;

    /**
     * Additional custom data associated with the product.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the product.
     */
    #[Required]
    public string $product_id;

    /**
     * Tax category associated with the product.
     *
     * @var value-of<TaxCategory> $tax_category
     */
    #[Required(enum: TaxCategory::class)]
    public string $tax_category;

    /**
     * Timestamp when the product was last updated.
     */
    #[Required]
    public \DateTimeInterface $updated_at;

    /**
     * Currency of the price.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * Description of the product, optional.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * URL of the product image, optional.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * Name of the product, optional.
     */
    #[Optional(nullable: true)]
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
    #[Optional(nullable: true)]
    public ?int $price;

    /**
     * Details of the price.
     */
    #[Optional(nullable: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $price_detail;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional(nullable: true)]
    public ?bool $tax_inclusive;

    /**
     * `new ProductListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductListResponse::with(
     *   business_id: ...,
     *   created_at: ...,
     *   is_recurring: ...,
     *   metadata: ...,
     *   product_id: ...,
     *   tax_category: ...,
     *   updated_at: ...,
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
     * @param array<string,string> $metadata
     * @param TaxCategory|value-of<TaxCategory> $tax_category
     * @param Currency|value-of<Currency>|null $currency
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   type: value-of<Type>,
     *   pay_what_you_want?: bool|null,
     *   suggested_price?: int|null,
     *   tax_inclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   tax_inclusive?: bool|null,
     *   trial_period_days?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixed_price: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   tax_inclusive?: bool|null,
     * }|null $price_detail
     */
    public static function with(
        string $business_id,
        \DateTimeInterface $created_at,
        bool $is_recurring,
        array $metadata,
        string $product_id,
        TaxCategory|string $tax_category,
        \DateTimeInterface $updated_at,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?int $price = null,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price_detail = null,
        ?bool $tax_inclusive = null,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['is_recurring'] = $is_recurring;
        $obj['metadata'] = $metadata;
        $obj['product_id'] = $product_id;
        $obj['tax_category'] = $tax_category;
        $obj['updated_at'] = $updated_at;

        null !== $currency && $obj['currency'] = $currency;
        null !== $description && $obj['description'] = $description;
        null !== $image && $obj['image'] = $image;
        null !== $name && $obj['name'] = $name;
        null !== $price && $obj['price'] = $price;
        null !== $price_detail && $obj['price_detail'] = $price_detail;
        null !== $tax_inclusive && $obj['tax_inclusive'] = $tax_inclusive;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $obj = clone $this;
        $obj['is_recurring'] = $isRecurring;

        return $obj;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

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
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

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
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

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
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Details of the price.
     *
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   type: value-of<Type>,
     *   pay_what_you_want?: bool|null,
     *   suggested_price?: int|null,
     *   tax_inclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   tax_inclusive?: bool|null,
     *   trial_period_days?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixed_price: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   tax_inclusive?: bool|null,
     * }|null $priceDetail
     */
    public function withPriceDetail(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $priceDetail
    ): self {
        $obj = clone $this;
        $obj['price_detail'] = $priceDetail;

        return $obj;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

        return $obj;
    }
}
