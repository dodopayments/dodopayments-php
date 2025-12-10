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
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   metadata: array<string,string>,
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
    /** @use SdkModel<ProductListResponseShape> */
    use SdkModel;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Timestamp when the product was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Required('is_recurring')]
    public bool $isRecurring;

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
    #[Required('product_id')]
    public string $productID;

    /**
     * Tax category associated with the product.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Timestamp when the product was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

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
    #[Optional('price_detail', nullable: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $priceDetail;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional('tax_inclusive', nullable: true)]
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
     * @param array<string,string> $metadata
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param Currency|value-of<Currency>|null $currency
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   type: value-of<Type>,
     *   payWhatYouWant?: bool|null,
     *   suggestedPrice?: int|null,
     *   taxInclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   taxInclusive?: bool|null,
     *   trialPeriodDays?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixedPrice: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   taxInclusive?: bool|null,
     * }|null $priceDetail
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
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $priceDetail = null,
        ?bool $taxInclusive = null,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['isRecurring'] = $isRecurring;
        $self['metadata'] = $metadata;
        $self['productID'] = $productID;
        $self['taxCategory'] = $taxCategory;
        $self['updatedAt'] = $updatedAt;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $image && $self['image'] = $image;
        null !== $name && $self['name'] = $name;
        null !== $price && $self['price'] = $price;
        null !== $priceDetail && $self['priceDetail'] = $priceDetail;
        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $self = clone $this;
        $self['isRecurring'] = $isRecurring;

        return $self;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Tax category associated with the product.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Currency of the price.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
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
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Details of the price.
     *
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   type: value-of<Type>,
     *   payWhatYouWant?: bool|null,
     *   suggestedPrice?: int|null,
     *   taxInclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   taxInclusive?: bool|null,
     *   trialPeriodDays?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixedPrice: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   taxInclusive?: bool|null,
     * }|null $priceDetail
     */
    public function withPriceDetail(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $priceDetail
    ): self {
        $self = clone $this;
        $self['priceDetail'] = $priceDetail;

        return $self;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }
}
