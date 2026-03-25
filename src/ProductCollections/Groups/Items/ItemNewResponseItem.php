<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups\Items;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;

/**
 * @phpstan-import-type PriceVariants from \Dodopayments\Products\Price
 * @phpstan-import-type PriceShape from \Dodopayments\Products\Price
 *
 * @phpstan-type ItemNewResponseItemShape = array{
 *   id: string,
 *   addonsCount: int,
 *   filesCount: int,
 *   hasCreditEntitlements: bool,
 *   isRecurring: bool,
 *   licenseKeyEnabled: bool,
 *   metersCount: int,
 *   productID: string,
 *   status: bool,
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   priceDetail?: PriceShape|null,
 *   taxCategory?: null|TaxCategory|value-of<TaxCategory>,
 *   taxInclusive?: bool|null,
 * }
 */
final class ItemNewResponseItem implements BaseModel
{
    /** @use SdkModel<ItemNewResponseItemShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('addons_count')]
    public int $addonsCount;

    #[Required('files_count')]
    public int $filesCount;

    /**
     * Whether this product has any credit entitlements attached.
     */
    #[Required('has_credit_entitlements')]
    public bool $hasCreditEntitlements;

    #[Required('is_recurring')]
    public bool $isRecurring;

    #[Required('license_key_enabled')]
    public bool $licenseKeyEnabled;

    #[Required('meters_count')]
    public int $metersCount;

    #[Required('product_id')]
    public string $productID;

    #[Required]
    public bool $status;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional(nullable: true)]
    public ?int $price;

    /**
     * One-time price details.
     *
     * @var PriceVariants|null $priceDetail
     */
    #[Optional('price_detail', nullable: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $priceDetail;

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @var value-of<TaxCategory>|null $taxCategory
     */
    #[Optional('tax_category', enum: TaxCategory::class, nullable: true)]
    public ?string $taxCategory;

    #[Optional('tax_inclusive', nullable: true)]
    public ?bool $taxInclusive;

    /**
     * `new ItemNewResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemNewResponseItem::with(
     *   id: ...,
     *   addonsCount: ...,
     *   filesCount: ...,
     *   hasCreditEntitlements: ...,
     *   isRecurring: ...,
     *   licenseKeyEnabled: ...,
     *   metersCount: ...,
     *   productID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemNewResponseItem)
     *   ->withID(...)
     *   ->withAddonsCount(...)
     *   ->withFilesCount(...)
     *   ->withHasCreditEntitlements(...)
     *   ->withIsRecurring(...)
     *   ->withLicenseKeyEnabled(...)
     *   ->withMetersCount(...)
     *   ->withProductID(...)
     *   ->withStatus(...)
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
     * @param Currency|value-of<Currency>|null $currency
     * @param PriceShape|null $priceDetail
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public static function with(
        string $id,
        int $addonsCount,
        int $filesCount,
        bool $hasCreditEntitlements,
        bool $isRecurring,
        bool $licenseKeyEnabled,
        int $metersCount,
        string $productID,
        bool $status,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $name = null,
        ?int $price = null,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $priceDetail = null,
        TaxCategory|string|null $taxCategory = null,
        ?bool $taxInclusive = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['addonsCount'] = $addonsCount;
        $self['filesCount'] = $filesCount;
        $self['hasCreditEntitlements'] = $hasCreditEntitlements;
        $self['isRecurring'] = $isRecurring;
        $self['licenseKeyEnabled'] = $licenseKeyEnabled;
        $self['metersCount'] = $metersCount;
        $self['productID'] = $productID;
        $self['status'] = $status;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $price && $self['price'] = $price;
        null !== $priceDetail && $self['priceDetail'] = $priceDetail;
        null !== $taxCategory && $self['taxCategory'] = $taxCategory;
        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAddonsCount(int $addonsCount): self
    {
        $self = clone $this;
        $self['addonsCount'] = $addonsCount;

        return $self;
    }

    public function withFilesCount(int $filesCount): self
    {
        $self = clone $this;
        $self['filesCount'] = $filesCount;

        return $self;
    }

    /**
     * Whether this product has any credit entitlements attached.
     */
    public function withHasCreditEntitlements(bool $hasCreditEntitlements): self
    {
        $self = clone $this;
        $self['hasCreditEntitlements'] = $hasCreditEntitlements;

        return $self;
    }

    public function withIsRecurring(bool $isRecurring): self
    {
        $self = clone $this;
        $self['isRecurring'] = $isRecurring;

        return $self;
    }

    public function withLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $self = clone $this;
        $self['licenseKeyEnabled'] = $licenseKeyEnabled;

        return $self;
    }

    public function withMetersCount(int $metersCount): self
    {
        $self = clone $this;
        $self['metersCount'] = $metersCount;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    public function withStatus(bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPrice(?int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * One-time price details.
     *
     * @param PriceShape|null $priceDetail
     */
    public function withPriceDetail(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $priceDetail
    ): self {
        $self = clone $this;
        $self['priceDetail'] = $priceDetail;

        return $self;
    }

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public function withTaxCategory(TaxCategory|string|null $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }
}
