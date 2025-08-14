<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Refunds\RefundCreateParams\Item;

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

    /**
     * `new RefundCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RefundCreateParams::with(paymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RefundCreateParams)->withPaymentID(...)
     * ```
     */
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
    public static function with(
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
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * Partially Refund an Individual Item.
     *
     * @param null|list<Item> $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }
}
