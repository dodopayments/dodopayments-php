<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * A note changes no field, so it needs no `If-Match`. The note shows in `/events`.
 *
 * @see Dodopayments\Services\InvoicesService::addNote()
 *
 * @phpstan-type InvoiceAddNoteParamsShape = array{text: string}
 */
final class InvoiceAddNoteParams implements BaseModel
{
    /** @use SdkModel<InvoiceAddNoteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $text;

    /**
     * `new InvoiceAddNoteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceAddNoteParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceAddNoteParams)->withText(...)
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
    public static function with(string $text): self
    {
        $self = new self;

        $self['text'] = $text;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
