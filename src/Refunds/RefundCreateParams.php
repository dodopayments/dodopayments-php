<?php

declare(strict_types=1);

namespace DodoPayments\Refunds;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Refunds\RefundCreateParams\Item;

/**
 * @phpstan-type create_params = array{
 *   paymentID: string, items?: list<Item>|null, reason?: string|null
 * }
 */
final class RefundCreateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The unique identifier of the payment to be refunded.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * Partially Refund an Individual Item.
     *
     * @var null|list<Item> $items
     */
    #[Api(type: new ListOf(Item::class), nullable: true, optional: true)]
    public ?array $items;

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    #[Api(optional: true)]
    public ?string $reason;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<Item> $items
     */
    public static function from(
        string $paymentID,
        ?array $items = null,
        ?string $reason = null
    ): self {
        $obj = new self;

        $obj->paymentID = $paymentID;

        null !== $items && $obj->items = $items;
        null !== $reason && $obj->reason = $reason;

        return $obj;
    }

    /**
     * The unique identifier of the payment to be refunded.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * Partially Refund an Individual Item.
     *
     * @param null|list<Item> $items
     */
    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }
}
