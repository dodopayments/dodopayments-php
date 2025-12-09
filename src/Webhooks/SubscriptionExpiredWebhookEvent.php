<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent\Data;
use Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent\Data\PayloadType;
use Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent\Type;

/**
 * @phpstan-type SubscriptionExpiredWebhookEventShape = array{
 *   businessID: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class SubscriptionExpiredWebhookEvent implements BaseModel
{
    /** @use SdkModel<SubscriptionExpiredWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Event-specific data.
     */
    #[Required]
    public Data $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new SubscriptionExpiredWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionExpiredWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionExpiredWebhookEvent)
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
     *   cancelAtNextBillingDate: bool,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   nextBillingDate: \DateTimeInterface,
     *   onDemand: bool,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   previousBillingDate: \DateTimeInterface,
     *   productID: string,
     *   quantity: int,
     *   recurringPreTaxAmount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscriptionID: string,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   taxInclusive: bool,
     *   trialPeriodDays: int,
     *   cancelledAt?: \DateTimeInterface|null,
     *   discountCyclesRemaining?: int|null,
     *   discountID?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   paymentMethodID?: string|null,
     *   taxID?: string|null,
     *   payloadType?: value-of<PayloadType>|null,
     * } $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        Data|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj['businessID'] = $businessID;
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
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     *
     * @param Data|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancelAtNextBillingDate: bool,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   nextBillingDate: \DateTimeInterface,
     *   onDemand: bool,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   previousBillingDate: \DateTimeInterface,
     *   productID: string,
     *   quantity: int,
     *   recurringPreTaxAmount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscriptionID: string,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   taxInclusive: bool,
     *   trialPeriodDays: int,
     *   cancelledAt?: \DateTimeInterface|null,
     *   discountCyclesRemaining?: int|null,
     *   discountID?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   paymentMethodID?: string|null,
     *   taxID?: string|null,
     *   payloadType?: value-of<PayloadType>|null,
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
