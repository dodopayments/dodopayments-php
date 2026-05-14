<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;

/**
 * @phpstan-import-type CreditLedgerEntryShape from \Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry
 *
 * @phpstan-type CreditManualAdjustmentWebhookEventShape = array{
 *   businessID: string,
 *   data: CreditLedgerEntry|CreditLedgerEntryShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'credit.manual_adjustment',
 * }
 */
final class CreditManualAdjustmentWebhookEvent implements BaseModel
{
    /** @use SdkModel<CreditManualAdjustmentWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'credit.manual_adjustment' $type
     */
    #[Required]
    public string $type = 'credit.manual_adjustment';

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
     * `new CreditManualAdjustmentWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditManualAdjustmentWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditManualAdjustmentWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
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
     */
    public static function with(
        string $businessID,
        CreditLedgerEntry|array $data,
        \DateTimeInterface $timestamp,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;

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
     * @param 'credit.manual_adjustment' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
