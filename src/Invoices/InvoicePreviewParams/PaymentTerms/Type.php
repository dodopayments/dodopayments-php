<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type TypeShape = array{type: 'due_on_receipt'}
 */
final class Type implements BaseModel
{
    /** @use SdkModel<TypeShape> */
    use SdkModel;

    /** @var 'due_on_receipt' $type */
    #[Required]
    public string $type = 'due_on_receipt';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * @param 'due_on_receipt' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
