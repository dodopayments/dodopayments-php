<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Closes an open or past-due invoice. Applied credits go back to the customer wallet.
 *
 * @see Dodopayments\Services\InvoicesService::void()
 *
 * @phpstan-type InvoiceVoidParamsShape = array{ifMatch: string}
 */
final class InvoiceVoidParams implements BaseModel
{
    /** @use SdkModel<InvoiceVoidParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $ifMatch;

    /**
     * `new InvoiceVoidParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceVoidParams::with(ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceVoidParams)->withIfMatch(...)
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
