<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @see Dodopayments\Services\SubscriptionsService::update()
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   billing?: null|BillingAddress|array{
 *     country: value-of<CountryCode>,
 *     city?: string|null,
 *     state?: string|null,
 *     street?: string|null,
 *     zipcode?: string|null,
 *   },
 *   cancelAtNextBillingDate?: bool|null,
 *   customerName?: string|null,
 *   disableOnDemand?: null|DisableOnDemand|array{
 *     nextBillingDate: \DateTimeInterface
 *   },
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
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billing
     * @param DisableOnDemand|array{
     *   nextBillingDate: \DateTimeInterface
     * }|null $disableOnDemand
     * @param array<string,string>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public static function with(
        BillingAddress|array|null $billing = null,
        ?bool $cancelAtNextBillingDate = null,
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
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $disableOnDemand && $self['disableOnDemand'] = $disableOnDemand;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $nextBillingDate && $self['nextBillingDate'] = $nextBillingDate;
        null !== $status && $self['status'] = $status;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billing
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

    public function withCustomerName(?string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * @param DisableOnDemand|array{
     *   nextBillingDate: \DateTimeInterface
     * }|null $disableOnDemand
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
