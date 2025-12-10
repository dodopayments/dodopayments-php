<?php

declare(strict_types=1);

namespace Dodopayments\Payments\PaymentGetLineItemsResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   amount: int,
 *   itemsID: string,
 *   refundableAmount: int,
 *   tax: int,
 *   description?: string|null,
 *   name?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Required]
    public int $amount;

    #[Required('items_id')]
    public string $itemsID;

    #[Required('refundable_amount')]
    public int $refundableAmount;

    #[Required]
    public int $tax;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(amount: ..., itemsID: ..., refundableAmount: ..., tax: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withAmount(...)
     *   ->withItemsID(...)
     *   ->withRefundableAmount(...)
     *   ->withTax(...)
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
    public static function with(
        int $amount,
        string $itemsID,
        int $refundableAmount,
        int $tax,
        ?string $description = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['itemsID'] = $itemsID;
        $self['refundableAmount'] = $refundableAmount;
        $self['tax'] = $tax;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withItemsID(string $itemsID): self
    {
        $self = clone $this;
        $self['itemsID'] = $itemsID;

        return $self;
    }

    public function withRefundableAmount(int $refundableAmount): self
    {
        $self = clone $this;
        $self['refundableAmount'] = $refundableAmount;

        return $self;
    }

    public function withTax(int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

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
}
