<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\Frequency;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type MixedShape = array{type: 'mixed'}
 */
final class Mixed_ implements BaseModel
{
    /** @use SdkModel<MixedShape> */
    use SdkModel;

    /** @var 'mixed' $type */
    #[Required]
    public string $type = 'mixed';

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
     * @param 'mixed' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
