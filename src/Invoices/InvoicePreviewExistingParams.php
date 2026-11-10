<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoicePreviewExistingParams\Format;

/**
 * Preview a draft invoice.
 *
 * @see Dodopayments\Services\InvoicesService::previewExisting()
 *
 * @phpstan-type InvoicePreviewExistingParamsShape = array{
 *   format?: null|Format|value-of<Format>
 * }
 */
final class InvoicePreviewExistingParams implements BaseModel
{
    /** @use SdkModel<InvoicePreviewExistingParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Format|value-of<Format>|null $format
     */
    public static function with(Format|string|null $format = null): self
    {
        $self = new self;

        null !== $format && $self['format'] = $format;

        return $self;
    }

    /**
     * The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
