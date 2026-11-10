<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\Invoice;

/**
 * @phpstan-import-type InvoiceShape from \Dodopayments\Invoices\Invoice
 *
 * @phpstan-type InvoicePaidWebhookEventShape = array{
 *   businessID: string,
 *   data: Invoice|InvoiceShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'invoice.paid',
 * }
 */
final class InvoicePaidWebhookEvent implements BaseModel
{
    /** @use SdkModel<InvoicePaidWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'invoice.paid' $type
     */
    #[Required]
    public string $type = 'invoice.paid';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * An invoice-led invoice. Every read and every `invoice.*` webhook uses this schema.
     */
    #[Required]
    public Invoice $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new InvoicePaidWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoicePaidWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoicePaidWebhookEvent)
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
     * @param Invoice|InvoiceShape $data
     */
    public static function with(
        string $businessID,
        Invoice|array $data,
        \DateTimeInterface $timestamp
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
     * An invoice-led invoice. Every read and every `invoice.*` webhook uses this schema.
     *
     * @param Invoice|InvoiceShape $data
     */
    public function withData(Invoice|array $data): self
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
     * @param 'invoice.paid' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
