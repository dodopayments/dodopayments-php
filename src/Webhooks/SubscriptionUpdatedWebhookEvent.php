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
use Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent\Data;
use Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent\Data\PayloadType;
use Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent\Type;

/**
 * @phpstan-type SubscriptionUpdatedWebhookEventShape = array{
 *   businessID: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class SubscriptionUpdatedWebhookEvent implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatedWebhookEventShape> */
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
     * `new SubscriptionUpdatedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdatedWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdatedWebhookEvent)
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
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
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
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
