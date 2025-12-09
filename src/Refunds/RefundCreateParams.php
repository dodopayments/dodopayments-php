<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Refunds\RefundCreateParams\Item;

/**
 * @see Dodopayments\Services\RefundsService::create()
 *
 * @phpstan-type RefundCreateParamsShape = array{
 *   paymentID: string,
 *   items?: list<Item|array{
 *     itemID: string, amount?: int|null, taxInclusive?: bool|null
 *   }>|null,
 *   metadata?: array<string,string>,
 *   reason?: string|null,
 * }
 */
final class RefundCreateParams implements BaseModel
{
    /** @use SdkModel<RefundCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The unique identifier of the payment to be refunded.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * Partially Refund an Individual Item.
     *
     * @var list<Item>|null $items
     */
    #[Optional(list: Item::class, nullable: true)]
    public ?array $items;

    /**
     * Additional metadata associated with the refund.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    #[Optional(nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Item|array{
     *   itemID: string, amount?: int|null, taxInclusive?: bool|null
     * }>|null $items
     * @param array<string,string> $metadata
     */
    public static function with(
        string $paymentID,
        ?array $items = null,
        ?array $metadata = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj['paymentID'] = $paymentID;

        null !== $items && $obj['items'] = $items;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $reason && $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * The unique identifier of the payment to be refunded.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
    }

    /**
     * Partially Refund an Individual Item.
     *
     * @param list<Item|array{
     *   itemID: string, amount?: int|null, taxInclusive?: bool|null
     * }>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }

    /**
     * Additional metadata associated with the refund.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }
}
