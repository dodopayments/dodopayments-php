<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DisableOnDemandShape = array{
 *   next_billing_date: \DateTimeInterface
 * }
 */
final class DisableOnDemand implements BaseModel
{
    /** @use SdkModel<DisableOnDemandShape> */
    use SdkModel;

    #[Api]
    public \DateTimeInterface $next_billing_date;

    /**
     * `new DisableOnDemand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisableOnDemand::with(next_billing_date: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisableOnDemand)->withNextBillingDate(...)
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
    public static function with(\DateTimeInterface $next_billing_date): self
    {
        $obj = new self;

        $obj['next_billing_date'] = $next_billing_date;

        return $obj;
    }

    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj['next_billing_date'] = $nextBillingDate;

        return $obj;
    }
}
