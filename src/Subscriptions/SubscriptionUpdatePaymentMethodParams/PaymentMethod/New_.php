<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewShape = array{type: 'new', returnURL?: string|null}
 */
final class New_ implements BaseModel
{
    /** @use SdkModel<NewShape> */
    use SdkModel;

    /** @var 'new' $type */
    #[Required]
    public string $type = 'new';

    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $returnURL = null): self
    {
        $self = new self;

        null !== $returnURL && $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * @param 'new' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }
}
