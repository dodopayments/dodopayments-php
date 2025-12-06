<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\Webhooks\SubscriptionActiveWebhookEvent\Data;
use Dodopayments\Webhooks\SubscriptionActiveWebhookEvent\Data\PayloadType;
use Dodopayments\Webhooks\SubscriptionActiveWebhookEvent\Type;

/**
 * @phpstan-type SubscriptionActiveWebhookEventShape = array{
 *   business_id: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class SubscriptionActiveWebhookEvent implements BaseModel
{
    /** @use SdkModel<SubscriptionActiveWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Api]
    public string $business_id;

    /**
     * Event-specific data.
     */
    #[Api]
    public Data $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * `new SubscriptionActiveWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionActiveWebhookEvent::with(
     *   business_id: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionActiveWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
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
     * @param Data|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     *   payload_type?: value-of<PayloadType>|null,
     * } $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $business_id,
        Data|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['data'] = $data;
        $obj['timestamp'] = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     *
     * @param Data|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     *   payload_type?: value-of<PayloadType>|null,
     * } $data
     */
    public function withData(Data|array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }

    /**
     * The event type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
