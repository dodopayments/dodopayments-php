<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item
 *
 * @phpstan-type CustomerGetPaymentMethodsResponseShape = array{
 *   items: list<Item|ItemShape>
 * }
 */
final class CustomerGetPaymentMethodsResponse implements BaseModel
{
    /** @use SdkModel<CustomerGetPaymentMethodsResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * `new CustomerGetPaymentMethodsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerGetPaymentMethodsResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerGetPaymentMethodsResponse)->withItems(...)
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
