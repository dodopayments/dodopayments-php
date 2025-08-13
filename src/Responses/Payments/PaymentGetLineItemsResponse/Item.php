<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Payments\PaymentGetLineItemsResponse;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type item_alias = array{
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
    use Model;

    #[Api]
    public int $amount;

    #[Api('items_id')]
    public string $itemsID;

    #[Api('refundable_amount')]
    public int $refundableAmount;

    #[Api]
    public int $tax;

    #[Api(optional: true)]
    public ?string $description;

    #[Api(optional: true)]
    public ?string $name;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        int $amount,
        string $itemsID,
        int $refundableAmount,
        int $tax,
        ?string $description = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->itemsID = $itemsID;
        $obj->refundableAmount = $refundableAmount;
        $obj->tax = $tax;

        null !== $description && $obj->description = $description;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setItemsID(string $itemsID): self
    {
        $this->itemsID = $itemsID;

        return $this;
    }

    public function setRefundableAmount(int $refundableAmount): self
    {
        $this->refundableAmount = $refundableAmount;

        return $this;
    }

    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
