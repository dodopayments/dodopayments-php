<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups\Items;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollections\Groups\ItemsService::delete()
 *
 * @phpstan-type ItemDeleteParamsShape = array{id: string, groupID: string}
 */
final class ItemDeleteParams implements BaseModel
{
    /** @use SdkModel<ItemDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Required]
    public string $groupID;

    /**
     * `new ItemDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemDeleteParams::with(id: ..., groupID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemDeleteParams)->withID(...)->withGroupID(...)
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
     */
    public static function with(string $id, string $groupID): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['groupID'] = $groupID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withGroupID(string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

        return $self;
    }
}
