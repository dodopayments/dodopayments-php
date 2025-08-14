<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type disable_on_demand_alias = array{
 *   nextBillingDate: \DateTimeInterface
 * }
 */
final class DisableOnDemand implements BaseModel
{
    use Model;

    #[Api('next_billing_date')]
    public \DateTimeInterface $nextBillingDate;

    /**
     * `new DisableOnDemand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisableOnDemand::with(nextBillingDate: ...)
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(\DateTimeInterface $nextBillingDate): self
    {
        $obj = new self;

        $obj->nextBillingDate = $nextBillingDate;

        return $obj;
    }

    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj->nextBillingDate = $nextBillingDate;

        return $obj;
    }
}
