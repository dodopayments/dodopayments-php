<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse\Meter;

/**
 * @phpstan-type subscription_get_usage_history_response = array{
 *   endDate: \DateTimeInterface,
 *   meters: list<Meter>,
 *   startDate: \DateTimeInterface,
 * }
 * When used in a response, this type parameter can be used to define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class SubscriptionGetUsageHistoryResponse implements BaseModel
{
    /** @use SdkModel<subscription_get_usage_history_response> */
    use SdkModel;

    /**
     * End date of the billing period.
     */
    #[Api('end_date')]
    public \DateTimeInterface $endDate;

    /**
     * List of meters and their usage for this billing period.
     *
     * @var list<Meter> $meters
     */
    #[Api(list: Meter::class)]
    public array $meters;

    /**
     * Start date of the billing period.
     */
    #[Api('start_date')]
    public \DateTimeInterface $startDate;

    /**
     * `new SubscriptionGetUsageHistoryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionGetUsageHistoryResponse::with(
     *   endDate: ..., meters: ..., startDate: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionGetUsageHistoryResponse)
     *   ->withEndDate(...)
     *   ->withMeters(...)
     *   ->withStartDate(...)
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
     *
     * @param list<Meter> $meters
     */
    public static function with(
        \DateTimeInterface $endDate,
        array $meters,
        \DateTimeInterface $startDate
    ): self {
        $obj = new self;

        $obj->endDate = $endDate;
        $obj->meters = $meters;
        $obj->startDate = $startDate;

        return $obj;
    }

    /**
     * End date of the billing period.
     */
    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $obj = clone $this;
        $obj->endDate = $endDate;

        return $obj;
    }

    /**
     * List of meters and their usage for this billing period.
     *
     * @param list<Meter> $meters
     */
    public function withMeters(array $meters): self
    {
        $obj = clone $this;
        $obj->meters = $meters;

        return $obj;
    }

    /**
     * Start date of the billing period.
     */
    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $obj = clone $this;
        $obj->startDate = $startDate;

        return $obj;
    }
}
