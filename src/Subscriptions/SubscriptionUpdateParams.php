<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\MetadataItem;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\CancelReason;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\CreditEntitlementCart;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @see Dodopayments\Services\SubscriptionsService::update()
 *
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CreditEntitlementCartShape from \Dodopayments\Subscriptions\SubscriptionUpdateParams\CreditEntitlementCart
 * @phpstan-import-type DisableOnDemandShape from \Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   billing?: null|BillingAddress|BillingAddressShape,
 *   cancelAtNextBillingDate?: bool|null,
 *   cancelReason?: null|CancelReason|value-of<CancelReason>,
 *   cancellationComment?: string|null,
 *   cancellationFeedback?: null|CancellationFeedback|value-of<CancellationFeedback>,
 *   creditEntitlementCart?: list<CreditEntitlementCart|CreditEntitlementCartShape>|null,
 *   customerBusinessName?: string|null,
 *   customerName?: string|null,
 *   disableOnDemand?: null|DisableOnDemand|DisableOnDemandShape,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   nextBillingDate?: \DateTimeInterface|null,
 *   status?: null|SubscriptionStatus|value-of<SubscriptionStatus>,
 *   subscriptionPeriodCount?: int|null,
 *   subscriptionPeriodInterval?: null|TimeInterval|value-of<TimeInterval>,
 *   taxID?: string|null,
 * }
 */
final class SubscriptionUpdateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?BillingAddress $billing;

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    #[Optional('cancel_at_next_billing_date', nullable: true)]
    public ?bool $cancelAtNextBillingDate;

    /** @var value-of<CancelReason>|null $cancelReason */
    #[Optional('cancel_reason', enum: CancelReason::class, nullable: true)]
    public ?string $cancelReason;

    /**
     * Free-text cancellation comment (only valid when cancelling or scheduling cancellation).
     */
    #[Optional('cancellation_comment', nullable: true)]
    public ?string $cancellationComment;

    /**
     * Customer-supplied churn reason (only valid when cancelling or scheduling cancellation).
     *
     * @var value-of<CancellationFeedback>|null $cancellationFeedback
     */
    #[Optional(
        'cancellation_feedback',
        enum: CancellationFeedback::class,
        nullable: true
    )]
    public ?string $cancellationFeedback;

    /**
     * Update credit entitlement cart settings.
     *
     * @var list<CreditEntitlementCart>|null $creditEntitlementCart
     */
    #[Optional(
        'credit_entitlement_cart',
        list: CreditEntitlementCart::class,
        nullable: true,
    )]
    public ?array $creditEntitlementCart;

    /**
     * Optional business / legal name associated with the tax id. When provided
     * together with a valid tax id for a B2B subscription, this name is rendered
     * on the invoice instead of the customer's personal name. Send `null` to
     * explicitly clear the business name.
     */
    #[Optional('customer_business_name', nullable: true)]
    public ?string $customerBusinessName;

    #[Optional('customer_name', nullable: true)]
    public ?string $customerName;

    #[Optional('disable_on_demand', nullable: true)]
    public ?DisableOnDemand $disableOnDemand;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class, nullable: true)]
    public ?array $metadata;

    #[Optional('next_billing_date', nullable: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /** @var value-of<SubscriptionStatus>|null $status */
    #[Optional(enum: SubscriptionStatus::class, nullable: true)]
    public ?string $status;

    /**
     * New number of `subscription_period_interval` units the subscription
     * entitlement should span. Used together with `subscription_period_interval`
     * to extend the subscription period. The resulting period must not be
     * shorter than the current one (this endpoint only extends).
     */
    #[Optional('subscription_period_count', nullable: true)]
    public ?int $subscriptionPeriodCount;

    /**
     * New interval unit for the subscription period. When changing the period,
     * this may be supplied alongside `subscription_period_count`; if omitted the
     * existing interval is retained.
     *
     * @var value-of<TimeInterval>|null $subscriptionPeriodInterval
     */
    #[Optional(
        'subscription_period_interval',
        enum: TimeInterval::class,
        nullable: true
    )]
    public ?string $subscriptionPeriodInterval;

    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BillingAddress|BillingAddressShape|null $billing
     * @param CancelReason|value-of<CancelReason>|null $cancelReason
     * @param CancellationFeedback|value-of<CancellationFeedback>|null $cancellationFeedback
     * @param list<CreditEntitlementCart|CreditEntitlementCartShape>|null $creditEntitlementCart
     * @param DisableOnDemand|DisableOnDemandShape|null $disableOnDemand
     * @param array<string,MetadataItemShape>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     * @param TimeInterval|value-of<TimeInterval>|null $subscriptionPeriodInterval
     */
    public static function with(
        BillingAddress|array|null $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        CancelReason|string|null $cancelReason = null,
        ?string $cancellationComment = null,
        CancellationFeedback|string|null $cancellationFeedback = null,
        ?array $creditEntitlementCart = null,
        ?string $customerBusinessName = null,
        ?string $customerName = null,
        DisableOnDemand|array|null $disableOnDemand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $nextBillingDate = null,
        SubscriptionStatus|string|null $status = null,
        ?int $subscriptionPeriodCount = null,
        TimeInterval|string|null $subscriptionPeriodInterval = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        null !== $billing && $self['billing'] = $billing;
        null !== $cancelAtNextBillingDate && $self['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;
        null !== $cancelReason && $self['cancelReason'] = $cancelReason;
        null !== $cancellationComment && $self['cancellationComment'] = $cancellationComment;
        null !== $cancellationFeedback && $self['cancellationFeedback'] = $cancellationFeedback;
        null !== $creditEntitlementCart && $self['creditEntitlementCart'] = $creditEntitlementCart;
        null !== $customerBusinessName && $self['customerBusinessName'] = $customerBusinessName;
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $disableOnDemand && $self['disableOnDemand'] = $disableOnDemand;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $nextBillingDate && $self['nextBillingDate'] = $nextBillingDate;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionPeriodCount && $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        null !== $subscriptionPeriodInterval && $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * @param BillingAddress|BillingAddressShape|null $billing
     */
    public function withBilling(BillingAddress|array|null $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    public function withCancelAtNextBillingDate(
        ?bool $cancelAtNextBillingDate
    ): self {
        $self = clone $this;
        $self['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;

        return $self;
    }

    /**
     * @param CancelReason|value-of<CancelReason>|null $cancelReason
     */
    public function withCancelReason(
        CancelReason|string|null $cancelReason
    ): self {
        $self = clone $this;
        $self['cancelReason'] = $cancelReason;

        return $self;
    }

    /**
     * Free-text cancellation comment (only valid when cancelling or scheduling cancellation).
     */
    public function withCancellationComment(?string $cancellationComment): self
    {
        $self = clone $this;
        $self['cancellationComment'] = $cancellationComment;

        return $self;
    }

    /**
     * Customer-supplied churn reason (only valid when cancelling or scheduling cancellation).
     *
     * @param CancellationFeedback|value-of<CancellationFeedback>|null $cancellationFeedback
     */
    public function withCancellationFeedback(
        CancellationFeedback|string|null $cancellationFeedback
    ): self {
        $self = clone $this;
        $self['cancellationFeedback'] = $cancellationFeedback;

        return $self;
    }

    /**
     * Update credit entitlement cart settings.
     *
     * @param list<CreditEntitlementCart|CreditEntitlementCartShape>|null $creditEntitlementCart
     */
    public function withCreditEntitlementCart(
        ?array $creditEntitlementCart
    ): self {
        $self = clone $this;
        $self['creditEntitlementCart'] = $creditEntitlementCart;

        return $self;
    }

    /**
     * Optional business / legal name associated with the tax id. When provided
     * together with a valid tax id for a B2B subscription, this name is rendered
     * on the invoice instead of the customer's personal name. Send `null` to
     * explicitly clear the business name.
     */
    public function withCustomerBusinessName(
        ?string $customerBusinessName
    ): self {
        $self = clone $this;
        $self['customerBusinessName'] = $customerBusinessName;

        return $self;
    }

    public function withCustomerName(?string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * @param DisableOnDemand|DisableOnDemandShape|null $disableOnDemand
     */
    public function withDisableOnDemand(
        DisableOnDemand|array|null $disableOnDemand
    ): self {
        $self = clone $this;
        $self['disableOnDemand'] = $disableOnDemand;

        return $self;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string,MetadataItemShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $self = clone $this;
        $self['nextBillingDate'] = $nextBillingDate;

        return $self;
    }

    /**
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public function withStatus(SubscriptionStatus|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * New number of `subscription_period_interval` units the subscription
     * entitlement should span. Used together with `subscription_period_interval`
     * to extend the subscription period. The resulting period must not be
     * shorter than the current one (this endpoint only extends).
     */
    public function withSubscriptionPeriodCount(
        ?int $subscriptionPeriodCount
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;

        return $self;
    }

    /**
     * New interval unit for the subscription period. When changing the period,
     * this may be supplied alongside `subscription_period_count`; if omitted the
     * existing interval is retained.
     *
     * @param TimeInterval|value-of<TimeInterval>|null $subscriptionPeriodInterval
     */
    public function withSubscriptionPeriodInterval(
        TimeInterval|string|null $subscriptionPeriodInterval
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;

        return $self;
    }

    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }
}
