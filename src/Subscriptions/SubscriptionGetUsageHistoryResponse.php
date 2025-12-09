<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse\Meter;

/**
 * @phpstan-type SubscriptionGetUsageHistoryResponseShape = array{
 *   end_date: \DateTimeInterface,
 *   meters: list<Meter>,
 *   start_date: \DateTimeInterface,
 * }
 */
final class SubscriptionGetUsageHistoryResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionGetUsageHistoryResponseShape> */
    use SdkModel;

    /**
     * End date of the billing period.
     */
    #[Api]
    public \DateTimeInterface $end_date;

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
    #[Api]
    public \DateTimeInterface $start_date;

    /**
     * `new SubscriptionGetUsageHistoryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionGetUsageHistoryResponse::with(
     *   end_date: ..., meters: ..., start_date: ...
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
     * @param list<Meter|array{
     *   id: string,
     *   chargeable_units: string,
     *   consumed_units: string,
     *   currency: value-of<Currency>,
     *   free_threshold: int,
     *   name: string,
     *   price_per_unit: string,
     *   total_price: int,
     * }> $meters
     */
    public static function with(
        \DateTimeInterface $end_date,
        array $meters,
        \DateTimeInterface $start_date
    ): self {
        $obj = new self;

        $obj['end_date'] = $end_date;
        $obj['meters'] = $meters;
        $obj['start_date'] = $start_date;

        return $obj;
    }

    /**
     * End date of the billing period.
     */
    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $obj = clone $this;
        $obj['end_date'] = $endDate;

        return $obj;
    }

    /**
     * List of meters and their usage for this billing period.
     *
     * @param list<Meter|array{
     *   id: string,
     *   chargeable_units: string,
     *   consumed_units: string,
     *   currency: value-of<Currency>,
     *   free_threshold: int,
     *   name: string,
     *   price_per_unit: string,
     *   total_price: int,
     * }> $meters
     */
    public function withMeters(array $meters): self
    {
        $obj = clone $this;
        $obj['meters'] = $meters;

        return $obj;
    }

    /**
     * Start date of the billing period.
     */
    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $obj = clone $this;
        $obj['start_date'] = $startDate;

        return $obj;
    }
}
