<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InvoiceEventShape from \Dodopayments\Invoices\InvoiceEvent
 *
 * @phpstan-type InvoiceListEventsResponseShape = array{
 *   items: list<InvoiceEvent|InvoiceEventShape>
 * }
 */
final class InvoiceListEventsResponse implements BaseModel
{
    /** @use SdkModel<InvoiceListEventsResponseShape> */
    use SdkModel;

    /** @var list<InvoiceEvent> $items */
    #[Required(list: InvoiceEvent::class)]
    public array $items;

    /**
     * `new InvoiceListEventsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceListEventsResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceListEventsResponse)->withItems(...)
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
     * @param list<InvoiceEvent|InvoiceEventShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<InvoiceEvent|InvoiceEventShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
