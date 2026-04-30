<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\CancelReason;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\CreditEntitlementCart;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @see Dodopayments\Services\SubscriptionsService::update()
 *
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CreditEntitlementCartShape from \Dodopayments\Subscriptions\SubscriptionUpdateParams\CreditEntitlementCart
 * @phpstan-import-type DisableOnDemandShape from \Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   billing?: null|BillingAddress|BillingAddressShape,
 *   cancelAtNextBillingDate?: bool|null,
 *   cancelReason?: null|CancelReason|value-of<CancelReason>,
 *   cancellationComment?: string|null,
 *   cancellationFeedback?: null|CancellationFeedback|value-of<CancellationFeedback>,
 *   creditEntitlementCart?: list<CreditEntitlementCart|CreditEntitlementCartShape>|null,
 *   customerName?: string|null,
 *   disableOnDemand?: null|DisableOnDemand|DisableOnDemandShape,
 *   metadata?: array<string,string>|null,
 *   nextBillingDate?: \DateTimeInterface|null,
 *   status?: null|SubscriptionStatus|value-of<SubscriptionStatus>,
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

    #[Optional('customer_name', nullable: true)]
    public ?string $customerName;

    #[Optional('disable_on_demand', nullable: true)]
    public ?DisableOnDemand $disableOnDemand;

    /** @var array<string,string>|null $metadata */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    #[Optional('next_billing_date', nullable: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /** @var value-of<SubscriptionStatus>|null $status */
    #[Optional(enum: SubscriptionStatus::class, nullable: true)]
    public ?string $status;

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
     * @param array<string,string>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public static function with(
        BillingAddress|array|null $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        CancelReason|string|null $cancelReason = null,
        ?string $cancellationComment = null,
        CancellationFeedback|string|null $cancellationFeedback = null,
        ?array $creditEntitlementCart = null,
        ?string $customerName = null,
        DisableOnDemand|array|null $disableOnDemand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $nextBillingDate = null,
        SubscriptionStatus|string|null $status = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        null !== $billing && $self['billing'] = $billing;
        null !== $cancelAtNextBillingDate && $self['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;
        null !== $cancelReason && $self['cancelReason'] = $cancelReason;
        null !== $cancellationComment && $self['cancellationComment'] = $cancellationComment;
        null !== $cancellationFeedback && $self['cancellationFeedback'] = $cancellationFeedback;
        null !== $creditEntitlementCart && $self['creditEntitlementCart'] = $creditEntitlementCart;
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $disableOnDemand && $self['disableOnDemand'] = $disableOnDemand;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $nextBillingDate && $self['nextBillingDate'] = $nextBillingDate;
        null !== $status && $self['status'] = $status;
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
     * @param array<string,string>|null $metadata
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

    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }
}
