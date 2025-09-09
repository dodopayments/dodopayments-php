<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @phpstan-type addon_response = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   name: string,
 *   price: int,
 *   taxCategory: value-of<TaxCategory>,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   image?: string|null,
 * }
 */
final class AddonResponse implements BaseModel
{
    /** @use SdkModel<addon_response> */
    use SdkModel;

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
     * @var value-of<TaxCategory> $taxCategory
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
        $obj = new self;

        $obj->id = $id;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
        $obj->name = $name;
        $obj->price = $price;
        $obj->taxCategory = $taxCategory instanceof TaxCategory ? $taxCategory->value : $taxCategory;
        $obj->updatedAt = $updatedAt;

        null !== $description && $obj->description = $description;
        null !== $image && $obj->image = $image;

        return $obj;
    }

    /**
     * id of the Addon.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the addon belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Created time.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

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
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

        return $obj;
    }

    /**
     * Name of the Addon.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(int $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

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
        $obj->taxCategory = $taxCategory instanceof TaxCategory ? $taxCategory->value : $taxCategory;

        return $obj;
    }

    /**
     * Updated time.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * Optional description of the Addon.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Image of the Addon.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }
}
