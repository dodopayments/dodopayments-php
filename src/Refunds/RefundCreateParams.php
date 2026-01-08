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
 * @phpstan-import-type ItemShape from \Dodopayments\Refunds\RefundCreateParams\Item
 *
 * @phpstan-type RefundCreateParamsShape = array{
 *   paymentID: string,
 *   items?: list<Item|ItemShape>|null,
 *   metadata?: array<string,string>|null,
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
     * @param list<Item|ItemShape>|null $items
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $paymentID,
        ?array $items = null,
        ?array $metadata = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['paymentID'] = $paymentID;

        null !== $items && $self['items'] = $items;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The unique identifier of the payment to be refunded.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Partially Refund an Individual Item.
     *
     * @param list<Item|ItemShape>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Additional metadata associated with the refund.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
