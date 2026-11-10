<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\Frequency;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type OneTimeShape = array{type: 'one_time'}
 */
final class OneTime implements BaseModel
{
    /** @use SdkModel<OneTimeShape> */
    use SdkModel;

    /** @var 'one_time' $type */
    #[Required]
    public string $type = 'one_time';

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
     * @param 'one_time' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
