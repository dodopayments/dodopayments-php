<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerListCreditEntitlementsResponse\Item;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Customers\CustomerListCreditEntitlementsResponse\Item
 *
 * @phpstan-type CustomerListCreditEntitlementsResponseShape = array{
 *   items: list<Item|ItemShape>
 * }
 */
final class CustomerListCreditEntitlementsResponse implements BaseModel
{
    /** @use SdkModel<CustomerListCreditEntitlementsResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * `new CustomerListCreditEntitlementsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerListCreditEntitlementsResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerListCreditEntitlementsResponse)->withItems(...)
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
     * @param list<Item|ItemShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
