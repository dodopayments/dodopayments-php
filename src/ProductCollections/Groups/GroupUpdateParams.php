<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollections\GroupsService::update()
 *
 * @phpstan-type GroupUpdateParamsShape = array{
 *   id: string,
 *   groupName?: string|null,
 *   productOrder?: list<string>|null,
 *   status?: bool|null,
 * }
 */
final class GroupUpdateParams implements BaseModel
{
    /** @use SdkModel<GroupUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Optional group name update: Some(Some(name)) = set name, Some(None) = clear name, None = no change.
     */
    #[Optional('group_name', nullable: true)]
    public ?string $groupName;

    /**
     * Optional new order for products in this group (array of product_collection_group_pdts UUIDs).
     *
     * @var list<string>|null $productOrder
     */
    #[Optional('product_order', list: 'string', nullable: true)]
    public ?array $productOrder;

    /**
     * Optional status update.
     */
    #[Optional(nullable: true)]
    public ?bool $status;

    /**
     * `new GroupUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GroupUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GroupUpdateParams)->withID(...)
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
     * @param list<string>|null $productOrder
     */
    public static function with(
        string $id,
        ?string $groupName = null,
        ?array $productOrder = null,
        ?bool $status = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $groupName && $self['groupName'] = $groupName;
        null !== $productOrder && $self['productOrder'] = $productOrder;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Optional group name update: Some(Some(name)) = set name, Some(None) = clear name, None = no change.
     */
    public function withGroupName(?string $groupName): self
    {
        $self = clone $this;
        $self['groupName'] = $groupName;

        return $self;
    }

    /**
     * Optional new order for products in this group (array of product_collection_group_pdts UUIDs).
     *
     * @param list<string>|null $productOrder
     */
    public function withProductOrder(?array $productOrder): self
    {
        $self = clone $this;
        $self['productOrder'] = $productOrder;

        return $self;
    }

    /**
     * Optional status update.
     */
    public function withStatus(?bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
