<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse\Meter;

/**
 * @phpstan-type SubscriptionGetUsageHistoryResponseShape = array{
 *   endDate: \DateTimeInterface,
 *   meters: list<Meter>,
 *   startDate: \DateTimeInterface,
 * }
 */
final class SubscriptionGetUsageHistoryResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionGetUsageHistoryResponseShape> */
    use SdkModel;

    /**
     * End date of the billing period.
     */
    #[Required('end_date')]
    public \DateTimeInterface $endDate;

    /**
     * List of meters and their usage for this billing period.
     *
     * @var list<Meter> $meters
     */
    #[Required(list: Meter::class)]
    public array $meters;

    /**
     * Start date of the billing period.
     */
    #[Required('start_date')]
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
     * @param list<Meter|array{
     *   id: string,
     *   chargeableUnits: string,
     *   consumedUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   totalPrice: int,
     * }> $meters
     */
    public static function with(
        \DateTimeInterface $endDate,
        array $meters,
        \DateTimeInterface $startDate
    ): self {
        $self = new self;

        $self['endDate'] = $endDate;
        $self['meters'] = $meters;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * End date of the billing period.
     */
    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * List of meters and their usage for this billing period.
     *
     * @param list<Meter|array{
     *   id: string,
     *   chargeableUnits: string,
     *   consumedUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   totalPrice: int,
     * }> $meters
     */
    public function withMeters(array $meters): self
    {
        $self = clone $this;
        $self['meters'] = $meters;

        return $self;
    }

    /**
     * Start date of the billing period.
     */
    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
