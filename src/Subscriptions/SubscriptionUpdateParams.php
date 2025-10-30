<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @see Dodopayments\Subscriptions->update
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   billing?: BillingAddress|null,
 *   cancelAtNextBillingDate?: bool|null,
 *   customerName?: string|null,
 *   disableOnDemand?: DisableOnDemand|null,
 *   metadata?: array<string, string>|null,
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

    #[Api(nullable: true, optional: true)]
    public ?BillingAddress $billing;

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    #[Api('cancel_at_next_billing_date', nullable: true, optional: true)]
    public ?bool $cancelAtNextBillingDate;

    #[Api('customer_name', nullable: true, optional: true)]
    public ?string $customerName;

    #[Api('disable_on_demand', nullable: true, optional: true)]
    public ?DisableOnDemand $disableOnDemand;

    /** @var array<string, string>|null $metadata */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    #[Api('next_billing_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /** @var value-of<SubscriptionStatus>|null $status */
    #[Api(enum: SubscriptionStatus::class, nullable: true, optional: true)]
    public ?string $status;

    #[Api('tax_id', nullable: true, optional: true)]
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
     * @param array<string, string>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public static function with(
        ?BillingAddress $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        ?string $customerName = null,
        ?DisableOnDemand $disableOnDemand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $nextBillingDate = null,
        SubscriptionStatus|string|null $status = null,
        ?string $taxID = null,
    ): self {
        $obj = new self;

        null !== $billing && $obj->billing = $billing;
        null !== $cancelAtNextBillingDate && $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;
        null !== $customerName && $obj->customerName = $customerName;
        null !== $disableOnDemand && $obj->disableOnDemand = $disableOnDemand;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $nextBillingDate && $obj->nextBillingDate = $nextBillingDate;
        null !== $status && $obj['status'] = $status;
        null !== $taxID && $obj->taxID = $taxID;

        return $obj;
    }

    public function withBilling(?BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    public function withCancelAtNextBillingDate(
        ?bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;

        return $obj;
    }

    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj->customerName = $customerName;

        return $obj;
    }

    public function withDisableOnDemand(?DisableOnDemand $disableOnDemand): self
    {
        $obj = clone $this;
        $obj->disableOnDemand = $disableOnDemand;

        return $obj;
    }

    /**
     * @param array<string, string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj->nextBillingDate = $nextBillingDate;

        return $obj;
    }

    /**
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public function withStatus(SubscriptionStatus|string|null $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj->taxID = $taxID;

        return $obj;
    }
}
