<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type UnionMember1Shape = array{days: int, type: 'net'}
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    /** @var 'net' $type */
    #[Required]
    public string $type = 'net';

    #[Required]
    public int $days;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(days: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withDays(...)
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
