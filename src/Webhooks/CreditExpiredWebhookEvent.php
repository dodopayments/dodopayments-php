<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\Webhooks\CreditExpiredWebhookEvent\Type;

/**
 * @phpstan-import-type CreditLedgerEntryShape from \Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry
 *
 * @phpstan-type CreditExpiredWebhookEventShape = array{
 *   businessID: string,
 *   data: CreditLedgerEntry|CreditLedgerEntryShape,
 *   timestamp: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class CreditExpiredWebhookEvent implements BaseModel
{
    /** @use SdkModel<CreditExpiredWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Response for a ledger entry.
     */
    #[Required]
    public CreditLedgerEntry $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CreditExpiredWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditExpiredWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditExpiredWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
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
     * @param CreditLedgerEntry|CreditLedgerEntryShape $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        CreditLedgerEntry|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Response for a ledger entry.
     *
     * @param CreditLedgerEntry|CreditLedgerEntryShape $data
     */
    public function withData(CreditLedgerEntry|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
