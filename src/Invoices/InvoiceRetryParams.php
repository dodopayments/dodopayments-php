<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Charges the saved payment method of the invoice subscription now.
 *
 * @see Dodopayments\Services\InvoicesService::retry()
 *
 * @phpstan-type InvoiceRetryParamsShape = array{ifMatch: string}
 */
final class InvoiceRetryParams implements BaseModel
{
    /** @use SdkModel<InvoiceRetryParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $ifMatch;

    /**
     * `new InvoiceRetryParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceRetryParams::with(ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceRetryParams)->withIfMatch(...)
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
    public static function with(string $ifMatch): self
    {
        $self = new self;

        $self['ifMatch'] = $ifMatch;

        return $self;
    }

    public function withIfMatch(string $ifMatch): self
    {
        $self = clone $this;
        $self['ifMatch'] = $ifMatch;

        return $self;
    }
}
