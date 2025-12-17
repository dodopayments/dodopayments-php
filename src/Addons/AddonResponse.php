<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @phpstan-type AddonResponseShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   name: string,
 *   price: int,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   updatedAt: \DateTimeInterface,
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
    #[Required]
    public string $id;

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Created time.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Currency of the Addon.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Name of the Addon.
     */
    #[Required]
    public string $name;

    /**
     * Amount of the addon.
     */
    #[Required]
    public int $price;

    /**
     * Tax category applied to this Addon.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Updated time.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Optional description of the Addon.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Image of the Addon.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * `new AddonResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonResponse::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   name: ...,
     *   price: ...,
     *   taxCategory: ...,
     *   updatedAt: ...,
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
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $taxCategory,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?string $image = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['name'] = $name;
        $self['price'] = $price;
        $self['taxCategory'] = $taxCategory;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $image && $self['image'] = $image;

        return $self;
    }

    /**
     * id of the Addon.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Created time.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Currency of the Addon.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Name of the Addon.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Tax category applied to this Addon.
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
     * Updated time.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Optional description of the Addon.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Image of the Addon.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }
}
