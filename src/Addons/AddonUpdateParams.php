<?php

declare(strict_types=1);

namespace Dodopayments\Addons;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @see Dodopayments\Services\AddonsService::update()
 *
 * @phpstan-type AddonUpdateParamsShape = array{
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   imageID?: string|null,
 *   name?: string|null,
 *   price?: int|null,
 *   taxCategory?: null|TaxCategory|value-of<TaxCategory>,
 * }
 */
final class AddonUpdateParams implements BaseModel
{
    /** @use SdkModel<AddonUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The currency of the Addon.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Addon image id after its uploaded to S3.
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Amount of the addon.
     */
    #[Optional(nullable: true)]
    public ?int $price;

    /**
     * Tax category of the Addon.
     *
     * @var value-of<TaxCategory>|null $taxCategory
     */
    #[Optional('tax_category', enum: TaxCategory::class, nullable: true)]
    public ?string $taxCategory;

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
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public static function with(
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?int $price = null,
        TaxCategory|string|null $taxCategory = null,
    ): self {
        $self = new self;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $imageID && $self['imageID'] = $imageID;
        null !== $name && $self['name'] = $name;
        null !== $price && $self['price'] = $price;
        null !== $taxCategory && $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * The currency of the Addon.
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
     * Description of the Addon, optional and must be at most 1000 characters.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Addon image id after its uploaded to S3.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * Name of the Addon, optional and must be at most 100 characters.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Amount of the addon.
     */
    public function withPrice(?int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Tax category of the Addon.
     *
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public function withTaxCategory(TaxCategory|string|null $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }
}
