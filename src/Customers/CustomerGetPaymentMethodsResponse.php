<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

/**
 * @phpstan-type CustomerGetPaymentMethodsResponseShape = array{items: list<Item>}
 */
final class CustomerGetPaymentMethodsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<CustomerGetPaymentMethodsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
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
     * @param list<Item> $items
     */
    public static function with(array $items): self
    {
        $obj = new self;

        $obj->items = $items;

        return $obj;
    }

    /**
     * @param list<Item> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }
}
