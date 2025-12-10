<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\LicenseKeys\LicenseKeyStatus;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment\PayloadType;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * @phpstan-type WebhookPayloadShape = array{
 *   businessID: string,
 *   data: Payment|Subscription|Refund|Dispute|LicenseKey,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<WebhookEventType>,
 * }
 */
final class WebhookPayload implements BaseModel
{
    /** @use SdkModel<WebhookPayloadShape> */
    use SdkModel;

    #[Required('business_id')]
    public string $businessID;

    /**
     * The latest data at the time of delivery attempt.
     */
    #[Required]
    public Payment|Subscription|Refund|Dispute|LicenseKey $data;

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Event types for Dodo events.
     *
     * @var value-of<WebhookEventType> $type
     */
    #[Required(enum: WebhookEventType::class)]
    public string $type;

    /**
     * `new WebhookPayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookPayload::with(businessID: ..., data: ..., timestamp: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookPayload)
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
     * @param Payment|array{
     *   billing: BillingAddress,
     *   brandID: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digitalProductsDelivered: bool,
     *   disputes: list<\Dodopayments\Disputes\Dispute>,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refunds: list<\Dodopayments\Payments\Payment\Refund>,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardLastFour?: string|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   checkoutSessionID?: string|null,
     *   discountID?: string|null,
     *   errorCode?: string|null,
     *   errorMessage?: string|null,
     *   paymentLink?: string|null,
     *   paymentMethod?: string|null,
     *   paymentMethodType?: string|null,
     *   productCart?: list<ProductCart>|null,
     *   settlementTax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscriptionID?: string|null,
     *   tax?: int|null,
     *   updatedAt?: \DateTimeInterface|null,
     *   payloadType: value-of<PayloadType>,
     * }|Subscription|array{
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
     *   payloadType: value-of<Subscription\PayloadType>,
     * }|Refund|array{
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   isPartial: bool,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refundID: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payloadType: value-of<Refund\PayloadType>,
     * }|Dispute|array{
     *   amount: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: string,
     *   customer: CustomerLimitedDetails,
     *   disputeID: string,
     *   disputeStage: value-of<DisputeStage>,
     *   disputeStatus: value-of<DisputeStatus>,
     *   paymentID: string,
     *   reason?: string|null,
     *   remarks?: string|null,
     *   payloadType: value-of<Dispute\PayloadType>,
     * }|LicenseKey|array{
     *   id: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   customerID: string,
     *   instancesCount: int,
     *   key: string,
     *   paymentID: string,
     *   productID: string,
     *   status: value-of<LicenseKeyStatus>,
     *   activationsLimit?: int|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   subscriptionID?: string|null,
     *   payloadType: value-of<LicenseKey\PayloadType>,
     * } $data
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public static function with(
        string $businessID,
        Payment|array|Subscription|Refund|Dispute|LicenseKey $data,
        \DateTimeInterface $timestamp,
        WebhookEventType|string $type,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The latest data at the time of delivery attempt.
     *
     * @param Payment|array{
     *   billing: BillingAddress,
     *   brandID: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digitalProductsDelivered: bool,
     *   disputes: list<\Dodopayments\Disputes\Dispute>,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refunds: list<\Dodopayments\Payments\Payment\Refund>,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardLastFour?: string|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   checkoutSessionID?: string|null,
     *   discountID?: string|null,
     *   errorCode?: string|null,
     *   errorMessage?: string|null,
     *   paymentLink?: string|null,
     *   paymentMethod?: string|null,
     *   paymentMethodType?: string|null,
     *   productCart?: list<ProductCart>|null,
     *   settlementTax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscriptionID?: string|null,
     *   tax?: int|null,
     *   updatedAt?: \DateTimeInterface|null,
     *   payloadType: value-of<PayloadType>,
     * }|Subscription|array{
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
     *   payloadType: value-of<Subscription\PayloadType>,
     * }|Refund|array{
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   isPartial: bool,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refundID: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payloadType: value-of<Refund\PayloadType>,
     * }|Dispute|array{
     *   amount: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: string,
     *   customer: CustomerLimitedDetails,
     *   disputeID: string,
     *   disputeStage: value-of<DisputeStage>,
     *   disputeStatus: value-of<DisputeStatus>,
     *   paymentID: string,
     *   reason?: string|null,
     *   remarks?: string|null,
     *   payloadType: value-of<Dispute\PayloadType>,
     * }|LicenseKey|array{
     *   id: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   customerID: string,
     *   instancesCount: int,
     *   key: string,
     *   paymentID: string,
     *   productID: string,
     *   status: value-of<LicenseKeyStatus>,
     *   activationsLimit?: int|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   subscriptionID?: string|null,
     *   payloadType: value-of<LicenseKey\PayloadType>,
     * } $data
     */
    public function withData(
        Payment|array|Subscription|Refund|Dispute|LicenseKey $data
    ): self {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Event types for Dodo events.
     *
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public function withType(WebhookEventType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
