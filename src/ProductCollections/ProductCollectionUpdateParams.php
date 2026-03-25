<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollectionsService::update()
 *
 * @phpstan-type ProductCollectionUpdateParamsShape = array{
 *   brandID?: string|null,
 *   description?: string|null,
 *   groupOrder?: list<string>|null,
 *   imageID?: string|null,
 *   name?: string|null,
 * }
 */
final class ProductCollectionUpdateParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional brand_id update.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Optional description update - pass null to remove, omit to keep unchanged.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Optional new order for groups (array of group UUIDs in desired order).
     *
     * @var list<string>|null $groupOrder
     */
    #[Optional('group_order', list: 'string', nullable: true)]
    public ?array $groupOrder;

    /**
     * Optional image update - pass null to remove, omit to keep unchanged.
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

    /**
     * Optional new name for the collection.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $groupOrder
     */
    public static function with(
        ?string $brandID = null,
        ?string $description = null,
        ?array $groupOrder = null,
        ?string $imageID = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $groupOrder && $self['groupOrder'] = $groupOrder;
        null !== $imageID && $self['imageID'] = $imageID;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Optional brand_id update.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Optional description update - pass null to remove, omit to keep unchanged.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Optional new order for groups (array of group UUIDs in desired order).
     *
     * @param list<string>|null $groupOrder
     */
    public function withGroupOrder(?array $groupOrder): self
    {
        $self = clone $this;
        $self['groupOrder'] = $groupOrder;

        return $self;
    }

    /**
     * Optional image update - pass null to remove, omit to keep unchanged.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * Optional new name for the collection.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
