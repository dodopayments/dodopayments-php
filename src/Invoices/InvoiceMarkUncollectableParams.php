<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Mark an invoice uncollectable.
 *
 * @see Dodopayments\Services\InvoicesService::markUncollectable()
 *
 * @phpstan-type InvoiceMarkUncollectableParamsShape = array{ifMatch: string}
 */
final class InvoiceMarkUncollectableParams implements BaseModel
{
    /** @use SdkModel<InvoiceMarkUncollectableParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $ifMatch;

    /**
     * `new InvoiceMarkUncollectableParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceMarkUncollectableParams::with(ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceMarkUncollectableParams)->withIfMatch(...)
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
