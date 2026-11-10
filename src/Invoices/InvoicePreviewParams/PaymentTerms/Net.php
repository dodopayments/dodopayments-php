<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NetShape = array{days: int, type: 'net'}
 */
final class Net implements BaseModel
{
    /** @use SdkModel<NetShape> */
    use SdkModel;

    /** @var 'net' $type */
    #[Required]
    public string $type = 'net';

    #[Required]
    public int $days;

    /**
     * `new Net()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Net::with(days: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Net)->withDays(...)
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
    public static function with(int $days): self
    {
        $self = new self;

        $self['days'] = $days;

        return $self;
    }

    public function withDays(int $days): self
    {
        $self = clone $this;
        $self['days'] = $days;

        return $self;
    }

    /**
     * @param 'net' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
